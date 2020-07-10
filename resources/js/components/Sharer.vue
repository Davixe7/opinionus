<template>
  <ul class="sharer-bar" :class="{vertical}">
    <li class="title">Share</li>
    <li>
      <a :href="twitterLink" title="Share this on Twitter" target="_blank">
        <svg height="100%" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;" version="1.1" viewBox="0 0 512 512" width="100%" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:serif="http://www.serif.com/" xmlns:xlink="http://www.w3.org/1999/xlink"><g><path d="M448,512l-384,0c-35.328,0 -64,-28.672 -64,-64l0,-384c0,-35.328 28.672,-64 64,-64l384,0c35.328,0 64,28.672 64,64l0,384c0,35.328 -28.672,64 -64,64Z" id="Dark_Blue" style="fill:#1da1f2;fill-rule:nonzero;"/><path d="M196.608,386.048c120.704,0 186.752,-100.096 186.752,-186.752c0,-2.816 0,-5.632 -0.128,-8.448c12.8,-9.216 23.936,-20.864 32.768,-34.048c-11.776,5.248 -24.448,8.704 -37.76,10.368c13.568,-8.064 23.936,-20.992 28.928,-36.352c-12.672,7.552 -26.752,12.928 -41.728,15.872c-12.032,-12.8 -29.056,-20.736 -47.872,-20.736c-36.224,0 -65.664,29.44 -65.664,65.664c0,5.12 0.64,10.112 1.664,14.976c-54.528,-2.688 -102.912,-28.928 -135.296,-68.608c-5.632,9.728 -8.832,20.992 -8.832,33.024c0,22.784 11.648,42.88 29.184,54.656c-10.752,-0.384 -20.864,-3.328 -29.696,-8.192l0,0.896c0,31.744 22.656,58.368 52.608,64.384c-5.504,1.536 -11.264,2.304 -17.28,2.304c-4.224,0 -8.32,-0.384 -12.288,-1.152c8.32,26.112 32.64,45.056 61.312,45.568c-22.528,17.664 -50.816,28.16 -81.536,28.16c-5.248,0 -10.496,-0.256 -15.616,-0.896c28.928,18.432 63.488,29.312 100.48,29.312" id="Logo__x2014__FIXED" style="fill:#fff;fill-rule:nonzero;"/></g></svg>
      </a>
    </li>
    <li>
      <a :href="facebookLink" title="Share this on facebook" target="_blank">
        <svg height="100%" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;" version="1.1" viewBox="0 0 512 512" width="100%" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:serif="http://www.serif.com/" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M449.446,0c34.525,0 62.554,28.03 62.554,62.554l0,386.892c0,34.524 -28.03,62.554 -62.554,62.554l-106.468,0l0,-192.915l66.6,0l12.672,-82.621l-79.272,0l0,-53.617c0,-22.603 11.073,-44.636 46.58,-44.636l36.042,0l0,-70.34c0,0 -32.71,-5.582 -63.982,-5.582c-65.288,0 -107.96,39.569 -107.96,111.204l0,62.971l-72.573,0l0,82.621l72.573,0l0,192.915l-191.104,0c-34.524,0 -62.554,-28.03 -62.554,-62.554l0,-386.892c0,-34.524 28.029,-62.554 62.554,-62.554l386.892,0Z" style="fill:#1777f2;"/></svg>
      </a>
    </li>
  </ul>
</template>

<script>
export default {
  props: ['link', 'vertical', 'message'],
  data(){
    return {
      twitterBaseUrl : 'https://twitter.com/intent/tweet?text=',
      facebookBaseUrl : 'http://www.facebook.com/sharer.php?u='
    }
  },
  computed:{
    twitterLink(){
      return this.twitterBaseUrl + encodeURI( this.message + ' ' ) + '&url=' + encodeURI( this.link )
    },
    facebookLink(){
      return this.facebookBaseUrl + this.link
    }
  }
}
</script>

<style lang="scss" scoped>
  .sharer-bar {
    display: flex;
    margin: 0;
    padding: 0;
    list-style-type: none;
    &.vertical {
      flex-flow: column nowrap;
      position: fixed;
      left: 0;
      top: 200px;
      z-index: 1000;
      background: #fff;
      padding: 10px;
      border-radius: 3px;
      box-shadow: 0 1px 3px 1px rgba(0,0,0,.14);
      
      li {
        margin: 0 0 10px 0;
        &:last-child {
          margin-bottom: 0;
        }
      }
    }
  }
  .sharer-bar li {
    margin-right: 10px;
    &.title {
      font-size: 12px;
      font-weight: 700;
      line-height: 30px;
      color: #B5B5B5;
    }
  }
  .sharer-bar li a {
    display: block;
    &:hover,&:active {
      text-decoration: none;
    }
    svg {
      width: 30px;
      height: 30px;
    }
  }
</style>
