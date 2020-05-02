<div class="card-body">
  <span class="form-section-title">All Banner Ads</span>
  @if( $banners && count($banners) )
  <div class="table-responsive">
    <table class="table table-sm">
      @foreach($banners as $banner)
        <tr>
          <td>{{ $banner->name }}</td>
          <td>
            <span><a target="_blank" href="{{ Storage::url($banner->image) }}"><i class="material-icons">photo</i></a></span>
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
              <a href="{{ route('admin.banners.edit', ['banner'=>$banner->id]) }}"><i class="material-icons">edit</i></a>
            </div>
            <form id="form-{{$banner->id}}" action="{{ route('admin.banners.destroy', ['banner'=>$banner->id]) }}" method="POST">
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