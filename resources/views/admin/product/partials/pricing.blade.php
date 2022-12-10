<div>
  @php
    $features = \App\Models\Feature::with(['feature_type','feature_values'])->orderBy('order','asc')->get();
  @endphp
  <input type="hidden" name="product_id" value="{{ @$product->id }}" class="form-control product-id" />

  <div class="clearfix mt-60px">
    <span class="pull-left fw-bold h2 m-0">Pricing</span>
    <span class="pull-right pt-3">
      <span class="fw-bold"> Offer Pacakges </span>
      <label class="switch">
        <input type="checkbox" name="no_of_inventories" id="no_of_inventories" checked />
        <span class="slider round"></span>
      </label>
    </span>
  </div>
  <div class="my-5 p-5 bg-primary">
    The scope of this feature is to drain more orders. Package prices should include predefined options.
  </div>
  <hr />
  <div class="fw-bold">Packages <span class="fw-bold text-green pointer" data-src="{{ config('shop.product.video.pricing.packages') }}" data-toggle="modal" data-target="#videoModal">How it works <i class="fa fa-play"></i></span></div>
  <div class="border">
    <div class="gig-pkg" id="overview">
      {{-- <form action="#" method="post" class="proposal-form-"> --}}

        <input type="hidden" name="variants[]" value="1" />
        <input type="hidden" name="variants[]" value="2" />
        <input type="hidden" name="variants[]" value="3" />
        <table class="table" id="pricingtable">
          <thead>
            <tr>
              <td></td>
              <td class="bg-light fw-bold p-4">Basic</td>
              <td class="bg-light fw-bold p-4">Standard</td>
              <td class="bg-light fw-bold p-4">Premium</td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td></td>
              <td><textarea name="title[]" placeholder="Basic package" style="color:#000; width:100%" rows="4">{{ @$inventories[0]->title }}</textarea></td>
              <td><textarea name="title[]" placeholder="Standard package" style="color:#000; width:100%" rows="4">{{ @$inventories[1]->title }}</textarea></td>
              <td><textarea name="title[]" placeholder="Premium package" style="color:#000; width:100%" rows="4">{{ @$inventories[2]->title }}</textarea></td>
            </tr>
            <tr>
              <td></td>
              <td><textarea style="color:#000; width:100%" name="description[]" placeholder="Describe your Basic package" rows="6">{{ @$inventories[0]->description }}</textarea></td>
              <td><textarea style="color:#000; width:100%" name="description[]" placeholder="Describe your Standard package" rows="6">{{ @$inventories[0]->description }}</textarea></td>
              <td><textarea style="color:#000; width:100%" name="description[]" placeholder="Describe your Premium package" rows="6">{{ @$inventories[0]->description }}</textarea></td>
              <td style="display:none"></td>
              <td style="display:none"></td>
            </tr>
            @foreach($features as $feature)
              <tr>
                <td>{{ $feature->name }}</td>
                <td class="p-4 text-center">
                  @if($feature->feature_type_id == 2)
                    <select class="form-control" name="features[0][{{ $feature->feature_type_id }}][]">
                      <option value=""></option>
                      @foreach($feature->feature_values as $value)
                      <option value="{{ $value->id }}">{{ $value->value }}</option>
                      @endforeach
                    </select>
                  @elseif($feature->feature_type_id == 3)
                    <input type="checkbox" name="features[0][{{ $feature->feature_type_id }}][]" value="1" />
                  @endif
                </td>
                <td class="p-4 text-center">
                  @if($feature->feature_type_id == 2)
                    <select class="form-control" name="features[1][{{ $feature->feature_type_id }}][]">
                      <option value=""></option>
                      @foreach($feature->feature_values as $value)
                      <option value="{{ $value->id }}">{{ $value->value }}</option>
                      @endforeach
                    </select>
                  @elseif($feature->feature_type_id == 3)
                    <input type="checkbox" name="features[1][{{ $feature->feature_type_id }}][]" value="1" />
                  @endif
                </td>
                <td class="p-4 text-center">
                  @if($feature->feature_type_id == 2)
                    <select class="form-control" name="features[2][{{ $feature->feature_type_id }}][]">
                      <option value=""></option>
                      @foreach($feature->feature_values as $value)
                      <option value="{{ $value->id }}">{{ $value->value }}</option>
                      @endforeach
                    </select>
                  @elseif($feature->feature_type_id == 3)
                    <input type="checkbox" name="features[2][{{ $feature->feature_type_id }}][]" value="1" />
                  @endif
                </td>
              </tr>
            @endforeach
            <tr class="price-tr">
              <td>Price</td>
              <td class="">
                <div class="input-group">
                  <input type="number" name="sale_price[]" value="{{ @$inventories[0]->sale_price }}" class="form-control" />
                  <div class="input-group-addon">
                    <span class="input-group-text">{{ get_currency_prefix() }}</span>
                  </div>
                </div>
              </td>
              <td class="">
                <div class="input-group">
                  <input type="number" name="sale_price[]" value="{{ @$inventories[1]->sale_price }}" class="form-control" />
                  <div class="input-group-addon">
                    <span class="input-group-text">{{ get_currency_prefix() }}</span>
                  </div>
                </div>
              </td>
              <td class="">
                <div class="input-group">
                  <input type="number" name="sale_price[]" value="{{ @$inventories[2]->sale_price }}" class="form-control" />
                  <div class="input-group-addon">
                    <span class="input-group-text">{{ get_currency_prefix() }}</span>
                  </div>
                </div>
              </td>
            </tr>
            <tr class="delivery-tr">
              <td>Delivery</td>
              <td class="">
                <input type="number" name="delivery_days[]" value="{{ @$inventories[0]->delivery_days }}" class="form-control" min="1" max="45" />
              </td>
              <td class="">
                <input type="number" name="delivery_days[]" value="{{ @$inventories[1]->delivery_days }}" class="form-control" min="1" max="45" />
              </td>
              <td class="">
                <input type="number" name="delivery_days[]" value="{{ @$inventories[2]->delivery_days }}" class="form-control" min="1" max="45" />
              </td>
            </tr> 
          </tbody>
        </table>
    </div>
  </div>
  <div class="my-5 clearfix">
    <span href="" class="btn btn-gig btn-outline-secondary pull-left">Cancel</span>
    <button class="btn btn-gig btn-success pull-right" form="pricing-form">Save</button>
  </div>
</div>