<div class="card-body">
  <span class="form-section-title">All Banner Ads</span>
  @if( $banners && count($banners) )
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
            <a onclick="document.querySelector('#form-{{$banner->id}}').submit()"><i class="material-icons">delete</i></a>
            <a href="{{ route('banners.edit', ['banner'=>$banner->id]) }}"><i class="material-icons">edit</i></a>
          </div>
          <form id="form-{{$banner->id}}" action="{{ route('banners.destroy', ['banner'=>$banner->id]) }}" method="POST">
            @csrf
            @method('DELETE')
          </form>
        </td>
      </tr>
    @endforeach
  </table>
  @else
  <div class="alert alert-info d-flex align-items-center">
    <i class="material-icons mr-3">info</i> 
    No banners added yet
  </div>
  @endif
</div>