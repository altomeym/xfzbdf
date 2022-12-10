<?php

namespace App\Http\Controllers\Admin;

use App\Common\Authorizable;
use App\Events\Message\MessageReplied;
use App\Events\Message\NewMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\CreateMessageRequest;
use App\Http\Requests\Validations\DraftSendRequest;
use App\Http\Requests\Validations\ReplyMessageRequest;
use App\Http\Requests\Validations\UpdateMessageRequest;
use App\Models\Order;
use App\Repositories\Message\MessageRepository;
use Illuminate\Http\Request;

// hassan
use Webklex\PHPIMAP\ClientManager;
use Webklex\PHPIMAP\Client;
use App\Models\Customer;
use Carbon\Carbon;

use MessageHelper;


class MessageController extends Controller
{
    use Authorizable;

    private $model;

    private $message;

    /**
     * construct
     */
    public function __construct(MessageRepository $message)
    {
        parent::__construct();

        $this->model = trans('app.model.message');

        $this->message = $message;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function labelOf($label = 1)
    {

        // start hassan
        // move to helper
        

        // $cm = new ClientManager('config/imap.php');
        
        // $client = $cm->make([
        //     'host'          => 'tiejet.net',
        //     'port'          => env('IMAP_PORT', 993),
        //     'encryption'    => env('IMAP_ENCRYPTION', 'ssl'),
        //     'validate_cert' => env('IMAP_VALIDATE_CERT', false),
        //     'protocol'      => env('IMAP_PROTOCOL', 'imap'),
        //     'username'      => 'hassan@tiejet.net', // this will change
        //     'password'      => 'tayyab123QWE!',
        //     'options' => [
        //         'fetch_order' => 'desc',
        //     ]
        // ]);
        
        $client = MessageHelper::makeConnection(env('MAIL_USERNAME'), env('MAIL_PASSWORD'));

        // 1 inbox, 2 sent, 3 drafts, 4 spams, 5 trash,
        $cFolder = $client->getFolder(MessageHelper::mailBoxFolder(1));
        
        $query = $cFolder->query();
        $cMessage = $query->all()->unseen()->markAsRead()->get();
        // $cMessage = $query->all()->get();

        $request = new Request();
        // return $cMessage;
        foreach($cMessage as $index => $message){
            // print_r($message);
            // return response()->json([
            //     'messages' => $message->getSubject()
            // ]);
            // return $message;
            $from_emails_array = MessageHelper::getEmailArrayFromString((string)$message->getFrom());
            // $messages[$index]['from'] = $from_emails_array;
            // $messages[$index]['to'] = (array)$message->getAttributes();
            // $messages[$index]['date'] = Carbon::parse($message->getDate())->format('d-m-Y H:i:s');
            // $messages[$index]['subject'] = (string)$message->getSubject() ? (string)$message->getSubject() : '(No Subject)'; //substr($message->getSubject(), 0, strpos($message->getSubject(), "\n"));
            // $messages[$index]['body'] = (string)$message->getHTMLBody(); //$message->bodies['text'];
            // $messages[$index]['flags'] =  $message->flags; // $message->getFlags();
            // $messages[$index]['message_id'] = $message->getUid();
            
            $customer = Customer::where('email',$from_emails_array[0])->first();
            if($customer){
                $customer_id = $customer->id;
                $customer_name = $customer->name;
                $email = $customer->email;
            }else{
                $customer_id = null;
                $customer_name = (string)$message->getFrom();
                $email = $from_emails_array[0];
            }
            //  this will change >> user request >>> message model
            // shop_id,user_id,customer_id, name, phone, email, subject, message, order_id, product_id, status, customer_status, label, deleted_at, created_at, updated_at
            $request->merge([
                'message_uid' => $message->getUid(),
                'customer_id' => $customer_id,
                'name' => $customer_name,
                'email' => $email,
                'subject' => (string)$message->getSubject() ? (string)$message->getSubject() : null,
                'message' => (string)$message->getHTMLBody(),
                'shop_id' => null, // messages coming direct from emails are not linked with shop
                'user_id' => '1', // this may be change >>> 1 for super admin
                'label' => '1', // 1 inbox, 2 sent, 3 drafts, 4 spams, 5 trash,
                'status' => '1', // 1 for new, 2 for mark as unread, 3 for mark as read    
                'customer_status' => '1', // when admin reply its become 2
                'created_at' =>  Carbon::parse($message->getDate())->format('Y-m-d H:i:s'),
                'updated_at' =>  Carbon::parse($message->getDate())->format('Y-m-d H:i:s'),
            ]);

            $message = $this->message->storeImap($request);

            // event(new NewMessage($message));
    
        }
        // return $cMessage;
        
        /*
            add sent msg to sent in imap
            add drafts msg to drafts in imap
            add trash msg to trash in imap
            mark as reaad/unread in imap
            >>add previous msg to sent so no new thread open
            >>received previous msg in previous mail so no new thread open
        */
        
        // end hassan
        $messages = $this->message->labelOf($label);

        return view('admin.message.index', compact('messages'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function statusOf($status = 1)
    {
        $messages = $this->message->statusOf($label);

        return view('admin.message.index', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type = null)
    {
        return view('admin.message._create', compact('type'));
    }

    public function orderConversation(Request $request, Order $order)
    {
        return view('admin.message._create', compact('order'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMessageRequest $request)
    {
        // return $request;
        $message = $this->message->store($request);

        event(new NewMessage($message));

        return back()->with('success', trans('messages.created', ['model' => $this->model]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int id
     * @return \Illuminate\Http\Response
     */
    public function draftSend(DraftSendRequest $request, $id)
    {
        $this->message->update($request, $id);

        if ($request->has('draft')) {
            return back()->with('success', trans('messages.updated', ['model' => $this->model]));
        }

        return back()->with('success', trans('messages.sent', ['model' => $this->model]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $message = $this->message->find($id);

        $message->markAsRead();

        return view('admin.message.show', compact('message'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $message = $this->message->find($id);

        return view('admin.message._edit', compact('message'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $statusOrLabel, $type = 'label')
    {
        $message = $this->message->find($id);

        // hassan changes start to sync mesage moving with live server
        if($message->message_uid){
            // // becuase the messages that does not have message_uid are not on server
            // $client = MessageHelper::makeConnection(env('MAIL_USERNAME'), env('MAIL_PASSWORD'));
            // $folder_path = MessageHelper::mailBoxFolder($message->label);
            // $cFolder = $client->getFolder($folder_path);
            // try {
            //     $__message = $cFolder->query()->getMessageByUid($message->message_uid);
            //     $__message->move($folder_path);    
            // } catch(Exception $e) {
            // // echo 'Message: ' .$e->getMessage();
            // }
        }
        // hassan changes end


        $backLabel = $message->label;

        $this->message->updateStatusOrLabel($request, $message, $statusOrLabel, $type);

        return redirect()->route('admin.support.message.labelOf', $backLabel)
            ->with('success', trans('messages.updated', ['model' => $this->model]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int id
     * @return \Illuminate\Http\Response
     */
    public function massUpdate(Request $request, $statusOrLabel, $type = 'label')
    {
        $this->message->massUpdate($request->ids, $statusOrLabel, $type);

        return response()->json(['success' => trans('messages.updated', ['model' => $this->model])]);
    }

    /**
     * Display the reply form.
     *
     * @param int id
     * @return \Illuminate\Http\Response
     */
    public function reply($id, $template = null)
    {
        $message = $this->message->find($id);

        return view('admin.message._reply', compact('message', 'template'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int id
     * @return \Illuminate\Http\Response
     */
    public function storeReply(ReplyMessageRequest $request, $id)
    {
        $reply = $this->message->storeReply($request, $id);

        event(new MessageReplied($reply));

        return back()->with('success', trans('messages.updated', ['model' => $this->model]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $message = $this->message->find($id);

        $backLabel = $message->label;

        $this->message->destroy($message);

        return redirect()->route('admin.support.message.labelOf', $backLabel)
            ->with('success', trans('messages.deleted', ['model' => $this->model]));
    }

    public function massDestroy(Request $request)
    {
        $this->message->massDestroy($request->ids);

        return response()->json(['success' => trans('messages.deleted', ['model' => $this->model])]);
    }
}
