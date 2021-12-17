<template>
    <div class="example">
        <p>Результат: {{ num * num }}</p>
        <input v-model="num">
    </div>
    
    
</template>

<style>
    example {margin-top:50px;}
</style>
<script>
    export default {
        data: function () {
            return {num:1}
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
