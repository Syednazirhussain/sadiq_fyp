<?php require('./autoload.php'); ?>
<?php 

   $isLogin = false;
   $messages = [];
   if (isset($_POST['signup'])) {

      if (
         isset($_POST['name']) && 
         isset($_POST['phone']) && 
         isset($_POST['address']) && 
         isset($_POST['email']) && 
         isset($_POST['password'])
      ) {

         $errors = [];
         if (!empty($_POST['name'])) {
            if (strlen($_POST['name']) > 25) {
               array_push($errors, 'Name must be less than 25 characters');
            }
         } else { 
            array_push($errors, 'Name is required');
         }

         if (!empty($_POST['phone'])) {
            if (is_numeric($_POST['phone'])) {
               if (strlen($_POST['phone']) > 15) {
                  array_push($errors, 'Phone no must be less than 15');
               }
            } else {
               array_push($errors, 'Phone must be numeric');
            }
         } else { 
            array_push($errors, 'Address is required(s)');
         }

         if (!empty($_POST['address'])) {
            if (strlen($_POST['address']) > 45) {
               array_push($errors, 'Name must be less than 45 characters');
            }
         } else { 
            array_push($errors, 'Address is required(s)');
         }

         if (!empty($_POST['email'])) {
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
               array_push($errors, 'Email not valid');
            }
         } else { 
            array_push($errors, 'Email is required(s)');
         }

         if (!empty($_POST['password'])) {
            if (!empty($_POST['confirm_password'])) {
               if ($_POST['password'] != $_POST['confirm_password']) {
                  array_push($errors, 'Password and confirm password not match');
               }
            } else { 
               array_push($errors, 'Confirm password is required(s)');
            }
         } else { 
            array_push($errors, 'Password is required(s)');
         }

         if (empty($errors)) {

            unset($_POST['signup']);
            $user = new user();
            if ($user->signup($_POST)) {
               unset($_POST);
               $messages['success'] = 'User register successfully';
            } else {
               $messages['error'] = 'Registeration Fail';
            }
         } else {
            $messages['error'] = $errors;
         }
      } else {

         $messages['error'] = 'Missing required(s) parameters';
      }
   }

   if (isset($_POST['login'])) {

      $isLogin = true;
      $errors = [];
      if (!empty($_POST['email'])) {
         if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            array_push($errors, 'Email not valid');
         }
      } else { 
         array_push($errors, 'Email is required(s)');
      }

      if (empty($_POST['password'])) {
         
         array_push($errors, 'Password is required(s)');
      }

      if (empty($errors)) {

         $user = new user();
         if ($user->login($_POST['email'], $_POST['password'])) {
            header('location: index.php');exit;
         } else {

            $messages['error'] = 'Invalid credentials';
         }
      } else {
         $messages['error'] = $errors;
      }
   }
?>
<?php include('layouts/header.php'); ?>

      <div class="breadcrumb">
         <div class="container">
            <div class="breadcrumb-inner">
               <ul class="list-inline list-unstyled">
                  <li><a href="index.html">Home</a></li>
                  <li class='active'>Login</li>
               </ul>
            </div>
         </div>
      </div>
      <div class="body-content">
         <div class="container">
            <div class="sign-in-page">
               <div class="row">    
                  <div class="col-md-6 col-sm-6 sign-in">
                     <h4 class="">Sign in</h4>
                     <?php
                        if ($isLogin) {
                           if (count($messages) > 0) {
                              if (isset($messages['success'])) {
                                 echo "<div class='alert alert-success'>".$messages['success']."</div>";
                              } else {
                                 if (is_array($messages['error'])) {
                                    echo "<div class='alert alert-danger'><ul class='list-unstyled'>";
                                    foreach ($messages['error'] as $error) {
                                       echo "<li>".$error."</li>";
                                    }
                                    echo "</ul></div>";
                                 } else {
                                    echo "<div class='alert alert-danger'>".$messages['error']."</div>";
                                 }
                              }
                           }
                        }
                     ?>
                     <form  action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="register-form outer-top-xs" role="form">
                        <div class="form-group">
                           <label class="info-title" for="email">Email <span>*</span></label>
                           <input type="email" name="email" class="form-control" id="email">
                        </div>
                        <div class="form-group">
                           <label class="info-title" for="password">Password <span>*</span></label>
                           <input type="password" name="password" class="form-control" id="password">
                        </div>
                        <div class="radio outer-xs">
                           <a href="javascript:void(0);" class="forgot-password pull-right">Forgot your Password?</a>
                        </div>
                        <button type="submit" name="login" class="btn-upper btn btn-primary checkout-page-button">Login</button>
                     </form>
                  </div>
                  <div class="col-md-6 col-sm-6 create-new-account">
                     <h4 class="checkout-subtitle">Create a new account</h4>
                     <?php
                        if (!$isLogin) {
                           if (count($messages) > 0) {
                              if (isset($messages['success'])) {
                                 echo "<div class='alert alert-success'>".$messages['success']."</div>";
                              } else {
                                 if (is_array($messages['error'])) {
                                    echo "<div class='alert alert-danger'><ul class='list-unstyled'>";
                                    foreach ($messages['error'] as $error) {
                                       echo "<li>".$error."</li>";
                                    }
                                    echo "</ul></div>";
                                 } else {
                                    echo "<div class='alert alert-danger'>".$messages['error']."</div>";
                                 }
                              }
                           }
                        }
                     ?>
                     <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="register-form outer-top-xs" role="form">
                        <div class="form-group">
                           <label class="info-title" for="name">Name <span>*</span></label>
                           <input type="text" name="name" class="form-control" value="<?php if (isset($_POST['name'])) { echo $_POST['name']; } ?>" id="name">
                        </div>
                        <div class="form-group">
                           <label class="info-title" for="phone">Phone Number <span>*</span></label>
                           <input type="phone" name="phone" class="form-control" value="<?php if (isset($_POST['phone'])) { echo $_POST['phone']; } ?>" id="phone">
                        </div>
                        <div class="form-group">
                           <label class="info-title" for="address">Address <span>*</span></label>
                           <textarea name="address" id="address" class="form-control" style="resize: none;"><?php if (isset($_POST['address'])) { echo $_POST['address']; } ?></textarea>
                        </div>
                        <div class="form-group">
                           <label class="info-title" for="email">Email <span>*</span></label>
                           <input type="email" class="form-control" name="email" value="<?php if (isset($_POST['email'])) { echo $_POST['email']; } ?>" id="email">
                        </div>
                        <div class="form-group">
                           <label class="info-title" for="password">Password <span>*</span></label>
                           <input type="password" class="form-control" name="password" id="password">
                        </div>
                        <div class="form-group">
                           <label class="info-title" for="confirm_password">Confirm Password <span>*</span></label>
                           <input type="password" name="confirm_password" class="form-control" id="confirm_password">
                        </div>
                        <button type="submit" name="signup" class="btn-upper btn btn-primary checkout-page-button">Sign Up</button>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>

<?php include('layouts/footer.php'); ?>