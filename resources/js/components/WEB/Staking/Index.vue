<template>
  <section class="web-staking-index-component">
    <section class="web-staking-index-banner">      
      <div class="banner-container">
        <div class="banner-title">{{trans('basic.staking')}}</div>
        <div class="banner-text">{{trans('staking.description')}} <a href="https://www.instagram.com/p/CW1fo3jDrE4/" target="_blank">{{trans('staking.consult')}}</a></div>
      </div>
    </section>
    
    <scan-staking-list></scan-staking-list>
  </section>
</template>

<script>
  export default {
    props: {},

    data() {
      return {}
    },

    watch: {},

    computed: {},

    methods: {},

    mounted() {}
  }
</script>
