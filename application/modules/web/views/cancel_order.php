<html>
<form action="<?php echo base_url('web/Payment/cancel_order');?>" method="post" class="form-horizontal">
                <div class="control-group">
                    <label class="control-label" for="order">Order Id</label>

                    <div class="controls">
                        <input class="span3" name="orderId" id="order" type="text" value=""/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="pay-button"></label>

                    <div class="controls">
                        <button class="btn btn-success" id="pay-button" type="submit">Cancel order</button>
                    </div>
                </div>
            </form>
    
</html>