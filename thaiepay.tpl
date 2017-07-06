<p class="payment_module">

<a href="javascript:$('#payment_thaiepay').submit();" title="{l s='Pay with ThaiEPay' mod='thaiepay'}">

<img src="{$this_path}thaiepay.gif" alt="{l s='Pay with ThaiEPay' mod='thaiepay'}" />

{l s='Pay with ' mod='thaiepay'} <b>THAIEPAY</b>
</a>


<form id="payment_thaiepay" method="post" action="{$urlAction}" >
  <input type="hidden" name="refno" value="{$refno}">
  <input type="hidden" name="merchantid" value="{$merchantid}">
  <input type="hidden" name="customeremail" value="{$customeremail}">
  <input type="hidden" name="productdetail" value="{$productdetail}">
  <input type="hidden" name="total" value="{$total}">
  <input type="hidden" name="cc" value="{$cc}">
</form>

</p>
