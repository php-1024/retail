<template>
  <div>
      <div class="quhuo alert_width popup_alert_hook" @click.stop>
        <p class="quhuoinfo">选择配送方式</p>
        <div class="max_height_box">
          <a href="javascript:;" :class="{'action' : distributionid == 1}" @click="select(1)">快递配送</a>
          <a href="javascript:;" :class="{'action' : distributionid == 2}" @click="select(2)">到店自提</a>
        </div>
        <div class="alert_btn_wz">
          <!-- <a href="javascript:;" class="btn_alert my_text_align btn_alert_bg1">取消</a> -->
          <a href="javascript:;" class="btn_alert my_text_align btn_alert_bg" @click="hiddendialog">确认</a>
        </div>
      </div>
  </div>
</template>

<script>
export default {
  data () {
    return {
      distributionid : 1
    }
  },
  props : {

  },
  methods : {
    hiddendialog (){
      this.$emit('on-close');
    },
    select (id){
      this.distributionid = id;
    }
  }
}
</script>
<style scoped>
.quhuo{
    width: 10.0rem;
    padding: 0 0;
    background: #ffffff;
    z-index: 100;
    min-height: 8.4rem;
    padding-bottom: 2.4rem;
    position: relative;
}
.quhuo .quhuoinfo {
    font-size: 0.8rem;
    color: rgb(0,0,0);
    text-align: center;
    padding: .75rem 0 .7rem 0;
    font-weight: 600;
}
.max_height_box {
    max-height: 20rem;
    overflow: auto;
    padding: 0 1.925rem;
}
.quhuo .max_height_box > a:first-child {
    margin-top: 0.25rem;
}
.quhuo .max_height_box .action {
    color: rgb(254,219,67);
    border: 0.025rem solid rgb(254,219,67);
}
.quhuo .max_height_box > a {
    display: block;
    width: 4.15rem;
    height: 1.4rem;
    line-height: 1.4rem;
    text-align: center;
    margin: 0.75rem auto;
    font-size: 0.7rem;
    -webkit-border-radius: 0.2rem;
    -moz-border-radius: 0.2rem;
    -ms-border-radius: 0.2rem;
    border-radius: 0.2rem;
    font-weight: 500;
    color: rgb(152,152,152);
    border: 0.025rem solid #b8b8b8;
}
.alert_btn_wz {
    position: absolute;
    left: 0;
    bottom: 0;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    width: 100%;
}
.alert_btn_wz .btn_alert {
    -webkit-box-flex: 1;
    -webkit-flex: 1;
    -ms-flex: 1;
    flex: 1;
    height: 2.4rem;
    line-height: 2.4rem;
    text-align: center;
}
.my_text_align {
    text-align: center;
    color: rgb(0,0,00);
    font-weight: 600;
}
.btn_alert_bg {
    background: rgb(254,219,67);
}
</style>
