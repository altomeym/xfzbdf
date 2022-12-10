{{--@component('mail::message')
Hi,
 
Before I talk too much, I wanted to give you your free @if($guide['type'] == 'pdf') pdf @else video @endif Guide, “{{ $guide['title'] }}”.

@if($guide['type'] == 'pdf')
<a href="{{ $guide['link'] }}">Click HERE</a> to download PDF.
@else
<a href="{{ $guide['link'] }}">Click HERE</a> to watch it right now.
@endif

 
And while youre here, make sure to whitelist my email by adding it to your contacts.
 
By the way, did you know that thousands of people just like you are already enjoying a handsome living with AliExpress dropshipping? 
 
Here are some proven success stories to fuel your inspiration:
$350,000+ In A Year: Felix Shares His Experience Of Dropshipping In Germany
$26,976 In 1 Year: How Chanong Makes Money Online In Philippines
$10,900+ Daily Revenue: Thats How You Make Money With eCommerce In Europe!
Want more? Find 50+ success stories from all over the world right HERE!
 
Join us on social media for more success stories, company news and special offers:
<br />
@if ($social_media_links = get_social_media_links())
@foreach ($social_media_links as $social_media => $link)
    @if($social_media != 'google-plus')
        <a style="text-decoration:none" href="{{ $link }}">
            {{ $social_media }}
        </a>
        <br />
    @endif
@endforeach
@endif
 
To your unprecedented growth and success,
{{ config('company.name') }} team
@component('mail::button', ['url' => $guide['link']])
Click Here
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
--}}

@component('mail::message')
<div>
  <div>
    <div style="padding: 8px 15px 0px; margin: 0px;">
      <div>
        <div style="text-align: center;"><span style="font-size: 22px;">Looking for an evergreen business idea?</span></div>
      </div>
      <div style="color: #535353;">
        <div style="padding: 0px; margin: 0px 0px 17px;">
          <div style="margin: 0 0 17px; padding: 0px;">
            <div style="margin: 0 0 17px; padding: 0px;">
              <div style="margin: 0 0 17px; padding: 0px;">
                <div style="margin: 0 0 17px; padding: 0px;">
                  <div style="margin: 0 0 17px; padding: 0px;">
                    <span style="font-size: 16px;">What to sell in your store to see constant demand?</span>
                  </div>
                  <div>Before I talk too much, I wanted to give you your free pdf Guide, “{{ $guide['title'] }}”.<br /><br />Click <a href="{{ $guide['link'] }}" target="_blank" rel="noopener noreferrer">HERE</a> to watch it right now or <a href="{{ $guide['link'] }}" target="_blank" rel="noopener">download its PDF</a> version.</div>
                  <div style="margin: 0 0 17px; padding: 0px;">
                    <span style="font-size: 16px;">Ready to see some of this year’s most requested products?</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

@component('mail::button', ['url' => $guide['link']])
DOWNLOAD FREE GUIDE
@endcomponent

    </div>
  </div>
  <div style="padding: 0px 15px; margin-left: auto; margin-right: auto;">
    <div>
      <div><span style="color: #535353; font-size: 16px;"><span style="white-space: normal;">Don't want to miss our ecommerce tutorials, marketing tips and big sales? Then make sure to whitelist our emails by <strong>adding Tiejet to your contacts</strong>.</span></span></div>
    </div>
  </div>
</div>
@endcomponent