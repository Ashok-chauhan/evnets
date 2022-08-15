<main class="form-signin w-100 m-auto">

<?php if($error_messages):?>
  <div class="alert alert-danger" role="alert">
  <?php echo $error_messages ;?>
</div>
<?php endif;?>


  <form method="POST" action="/ci3/users/authenticate">
    <img class="mb-4" src="http://embin.com/images/sml-logo.png" alt="" width="280" height="76">
    <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

    <div class="form-floating">
      <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Email address</label>
    </div>
    <div class="form-floating">
      <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>

    
    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2022</p>
  </form>
</main>