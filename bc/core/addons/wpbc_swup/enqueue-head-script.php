<style> 
.swup-transition-main {
  opacity: 1;
  transition: opacity 0.3s, transform 0.4s;
  transform: translate3d(0, 0, 0);
}
html.is-animating .swup-transition-main {
  opacity: 0;
  transform: translate3d(0, -60px, 0);
}
html.is-animating.is-leaving .swup-transition-main {
  opacity: 0;
  transform: translate3d(0, 60px, 0);
}
html.is-animating.swup-theme-reverse .swup-transition-main {
  opacity: 0;
  transform: translate3d(0, 60px, 0);
}
html.is-animating.swup-theme-reverse.is-leaving .swup-transition-main {
  opacity: 0;
  transform: translate3d(0, -60px, 0);
}

/*
.animation-class { 
}

html.is-animating .animation-class { 
}

html.is-changing .animation-class { 
}

html.is-leaving .animation-class { 
}

html.is-rendering .animation-class { 
}
*/
</style>