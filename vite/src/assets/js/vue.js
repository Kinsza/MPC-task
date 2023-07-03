// https://vitejs.dev/config/#build-polyfillmodulepreload
// using workaround https://github.com/vitejs/vite/issues/4786
if (import.meta.env.MODE !== 'development') {
    import('vite/modulepreload-polyfill')
  }

  // Vue
  import { createApp } from 'vue'


  const modules = import.meta.globEager('./components/*.vue')
  const components = {}
  for (const path in modules) {
    const name = path
      .split('/')
      .pop()
      .replace(/\.\w+$/, '')
  
    components[name] = modules[path].default
  }
  
  
  // if importing all is too much you can always do it manually
  // import HelloWorld from './components/HelloWorld.vue'
  // const components = {
  //   HelloWorld,
  // }
  
  // instantiate the Vue apps
  // Note our lookup is a wrapping div with .vue-app class
  let settings = {
  
  
    DOMAIN: '',
    
    // WP SETTINGS
    //BASE_IMG: '/wp-content/themes/miyovite/miyovite/src/assets/images/',
    BASE_IMG: '/src/assets/images/',
    API_BASE_PATH: "/wp-json/wp/v2/",
    API_ACF_OPTIONS: '/wp-json/acf/v3/options/options',
    API_BASE_PATH_C: "/wp-json/wp/v2/",
  
  };
  
    fetch(settings.DOMAIN + settings.API_ACF_OPTIONS)
      .then((res) => res.json())
      .then((res) => {
       
  
        for (const el of document.getElementsByClassName('vue-app')) {
          createApp({
            template: el.innerHTML,
            components,
          }, { options: res.acf }).mount(el)
        }
        
      });
  
  
  