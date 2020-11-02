<div class="sharer @if($horizontal ?? false) horizontal @endif">
  <div class="title">Share</div>
  <a href="{{ $survey['social_media_links']['facebook'][$mode] }}"
    target="_blank">
    <i class="op-icon facebook"></i>
  </a>
  <a href="{{ $survey['social_media_links']['twitter'][$mode] }}"
    target="_blank">
    <i class="op-icon twitter"></i>
  </a>
</div>
