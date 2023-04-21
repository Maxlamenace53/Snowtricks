// assets/vue/controllers/MyComponent.vue
<template>
  <div>Hello {{ name }}!</div>
  <p>bonjour</p>
</template>

<script setup>
defineProps({
  name: String
});
</script>