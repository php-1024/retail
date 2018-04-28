<template>
  <div>
      <div class="g-flexview">
          <div class="top">
              <div class="top_box">
          <a href="javascript:;" class="return_btn"></a>
          <a href="javascript:;" class="personal_btn"></a>
              </div>
          </div>
          <div class="order order_m">
        <div class="order_box">
          <h3 class="order_state">待支付</h3>
          <a href="javascript:;" id="address" class="address_btn" onclick="show('alert')"><i></i>添加收货地址</a>
          <a href="javascript:;" id="zitiinfo" class="address_btn" onclick="show('alert')"><i></i>添加自提信息</a>
        </div>
        <div class="emotion_icon"></div>
          </div>
          <div class="order">
        <div class="order_address">
            <div class="item border_top_4" @click="showdialog('isShowdialog')">
              <div class="row">
                <div class="col-20 item_info"><span>配送方式aa</span></div>
                <div class="col-80 item_icon">
              <p id="distribution">快递配送</p>
                </div>
              </div>
            </div>
            <div class="order_btn">
              <div class="row">
                <div class="col-20"><span class="dizhi">备注</span></div>
                <div class="col-80">
              <input type="text" name="" class="address_input" placeholder="你有什么需要交代的呢">
                </div>
              </div>
            </div>
        </div>
          </div>
          <div class="order order_m1">
            <div class="order_address1">
              <div class="row order_address_m">
                  <div class="col-50 dindanmx"><i></i>订单明细<em>&nbsp;&nbsp;(6份商品)</em></div>
                  <div class="col-50 riqi">2018-04-19 05:45</div>
                </div>
                  <div class="order_list">
                  <div class="row order_list_box">
                        <div class="col-60">2018春装新款格子修</div>
                        <div class="col-15">&#215;1</div>
                        <div class="col-25">&yen;88</div>
                    </div>
                    <div class="row order_list_box">
                        <div class="col-60">2018春装新款格子修</div>
                        <div class="col-15">&#215;1</div>
                        <div class="col-25">&yen;88</div>
                    </div>
                    <div class="row order_list_box">
                        <div class="col-60">2018春装新款格子修</div>
                        <div class="col-15">&#215;1</div>
                        <div class="col-25">&yen;88</div>
                    </div>
                    <div class="row order_list_box">
                        <div class="col-60">2018春装新款格子修</div>
                        <div class="col-15">&#215;1</div>
                        <div class="col-25">&yen;88</div>
                    </div>
                    <div class="row order_list_box">
                        <div class="col-60">2018春装新款格子修</div>
                        <div class="col-15">&#215;1</div>
                        <div class="col-25">&yen;88</div>
                    </div>
                    <div class="row order_list_box">
                        <div class="col-60">2018春装新款格子修</div>
                        <div class="col-15">&#215;1</div>
                        <div class="col-25">&yen;88</div>
                    </div>
                    <div class="row order_list_box">
                        <div class="col-60">2018春装新款格子修</div>
                        <div class="col-15">&#215;1</div>
                        <div class="col-25">&yen;88</div>
                    </div>
                    <div class="order_btn order_zongji">
                        <p><span class="yunfei">运费</span><em>请先添加收货地址</em></p>
                      </div>
                      <div class="order_btn order_zongji">
                        <p><em>总计</em>&nbsp;&nbsp;&yen;789</p>
                      </div>
                  </div>
            </div>
          </div>
          <div class="tijiao">
        <a href="javascript:;" class="tijao_btn">提交订单<em>&yen;568</em></a>
          </div>
      </div>
      <my-dialog :is-show="isShowdialog" @on-close="hiddendialog('isShowdialog')">
        <select-distribution @on-close="hiddendialog('isShowdialog')"></select-distribution>
      </my-dialog>
  </div>
</template>

<script>
import mydialog from "@/components/dialog/dialog"
import selectDistribution from "@/components/dialog/selectDistribution"
export default {
  components : {
    myDialog : mydialog,
    selectDistribution
  },
  data () {
    return {
      isShowdialog : false
    }
  },
  created(){
    this.$ajax.post('http://develop.01nnt.com/api/wechatApi/store_list').then((res) => {
      console.log(res);
    }, (err) =>{
      console.log(err);
    })
  },
  methods : {
    showdialog (attr){
      this[attr] = true;
    },
    hiddendialog (attr){
      this[attr] = false;
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped src='@/assets/css/onlineOrder15-4.css'>

</style>
