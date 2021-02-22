<div class="card-body">
  <span class="form-section-title">All Banner Ads</span>
  @if( $banners && count($banners) )
  <div class="table-responsive">
    <table class="table table-sm">
      @foreach($banners as $banner)
        <tr>
          <td>
            <update-banner-status :banner="{{ json_encode( $banner ) }}">
          </td>
          <td>{{ $banner->name }}</td>
          <td>
            <span>
              <a
                href="{{ asset( Storage::url($banner->image) ) }}"
                target="_blank">
                <i class="material-icons">photo</i>
              </a>
            </span>
          </td>
          <td><span>{{ $banner->url }}</span></td>
          <td class="text-right">
            <div class="btn-group">
              <a
                href="#"
                onclick="confirm('Are you sure you want to delete the banner?')
                  ? document.querySelector('#form-{{$banner->id}}').submit() 
                  : ''">
                <i class="material-icons">delete</i>
              </a>
              <a href="{{ route('dashboard.banners.edit', ['banner'=>$banner->id]) }}"><i class="material-icons">edit</i></a>
            </div>
            <form id="form-{{$banner->id}}" action="{{ route('dashboard.banners.destroy', ['banner'=>$banner->id]) }}" method="POST">
              @csrf
              @method('DELETE')
            </form>
          </td>
        </tr>
      @endforeach
    </table>
  </div>
  @else
  <div class="alert alert-info d-flex align-items-center">
    <i class="material-icons mr-3">info</i> 
    No banners added yet
  </div>
  @endif
</div>