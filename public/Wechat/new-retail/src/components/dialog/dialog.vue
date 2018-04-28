<template>
  <div>
      <div class="popup_alert" v-if="isShow" @click="hiddendialog" @touchmove.prevent>
          <slot></slot>
      </div>
  </div>
</template>

<script>
export default {
  data () {
    return {

    }
  },
  props : {
    isShow : {
      type : Boolean,
      default : false
    }
  },
  methods : {
    hiddendialog (){
      this.$emit('on-close');
    }
  }
}
</script>
<style>
.popup_alert{
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-flex-direction: row;
  flex-direction: row;
  -webkit-justify-content: center;
  -webkit-align-items: center;
  justify-content: center;
  align-items: center;
  background-color: rgba(0,0,0,.3);
  z-index: 99;
}
</style>
