<?php 
    require './common/header.php';
    require './common/navbar.php';
?>
<div class="feed-div">
    <div>You are logged in as <?php echo $_SESSION['userDetails']; ?></div>
    <div class="cart-butt" onclick="enable(event,'cart','items')">view cart</div>
    <div style="cursor:pointer;" onclick="enable(event,'items','cart')">view items</div>
</div>
<div class="items"><h2>Items</h2>
<div class="pane"></div>
</div>
<div class="cart" style="display:none;"><h2>Your cart</h2>
<div class="pane"></div>
<button class="btn btn-primary" onclick="checkout()" data-toggle="modal" data-target="#exampleModal">checkout</button>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Checkout form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>total amount is <span class="checkoutamt">0</span></p>
      <label for="address">Address:</label>
      <input id="address" type="text" placeholder="enter your address...">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="save()">Checkout</button>
      </div>
    </div>
  </div>
</div>
<div id="lb-back">
  <div id="lb-img"></div>
</div>
<script src="../Public/scripts/items.js"></script>
<?php 
    require './common/footer.php';
?>