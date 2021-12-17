<template>
  <div>
    <h1>Vue примеры</h1>

    <ul class="ul-menu">
        <li> <router-link :to="{ name: 'home' }">Home</router-link></li>
        <li> <router-link :to="{ name: 'hello' }">Hello World</router-link></li>
        <li><router-link :to="{ name: 'companies' }">Companies</router-link></li>
    <li><router-link :to="{ name: 'forms' }">Работа с формами</router-link></li>
        
    </ul>
   

    <div class="container container-main">
      <router-view></router-view>
    </div>
  </div>
</template>
<script>
  export default {}
</script>
