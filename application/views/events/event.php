<link rel="stylesheet" href="styles.css" />
   <link
     rel="stylesheet"
     href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"
   />
   <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

   

<div class="container-fluid">
   
    <div>
       <img class="img-fluid" src="<?php echo base_url().'uploads/'.$event[0]['banner']; ?>"/>
    </div>
    <div > 
        <h1><?php echo $event[0]['event_name'];?></h1>
    </div>
    <div> 
      <h5> Start date/time <?php echo $event[0]['start_date'];?>
        <span class=""><?php echo $event[0]['start_time'];?></spnan>
</h5>
    </div>
    <div>
        <h5> End date/time
        <?php echo $event[0]['end_date'];?>
        <span class=""><?php echo $event[0]['end_time'];?></span>
</h5>

    </div>

    <div> 
    <?php echo $event[0]['welcome_text'];?>
    </div>



    <!-- form -->
   
    <?php if($this->input->get('error')){
      print '<div class="alert alert-danger custom-centered p-3">'.$this->input->get('error').'</div>';
    }
    ?>

    <?php //echo form_open('dashboard/guests');?>


    
    <!-- col-md-4 col-md-offset-4 -->
    <form method="POST" action="<?php echo base_url().'events/register';?>" onsubmit="process(event)">

<div class="custom-centered p-3">
    <input type="hidden" name="slug" value=" <?php echo $this->uri->segment(3);?>">
        <label for="phone" class="form-label">Phone Number</label>
        <input type="tel" class="form-control" id="phone" name="phone"></br>

        <label for="name" class="form-label">Name</label>
        <div class="input-group ">
        <select id="title" name="title"   class=""  >
          <option value="Mr">Mr</option>
          <option value="Mrs">Mrs</option>
          <option value="Miss">Miss</option>
          <option value="Ms">Ms</option>
          <option value="Mme">Mme</option>
          <option value="Dr">Dr</option>
          <option value="Chan">Chan</option>
          <option value="Pres">Pres</option>
          <option value="Prof">Prof</option>
          <option value="Gov">Gov</option>
        </select>
          
        <input type="text" class="form-control" id="name" name="name" >
        </div>
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" >
        <label for="age" class="form-label">Age</label>
        <input type="number" class="form-control" id="age" name="age">

        <label for="gender" class="form-label">Gender</label>
        <select id="gender" name="gender" class="form-select" aria-label="Default select">
          <option value="male">Male</option>
          <option value="female">Female</option>
        </select>

        <label for="council_number" class="form-label">Medical council number</label>
        <input type="number" class="form-control" id="council_number" name="council_number">
        <label for="council_state" class="form-label">State councile name</label>
        <input type="text" class="form-control" id="council_state" name="council_state">

        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="1" id="terms" name="terms">
            <label class="form-check-label" for="terms">
              Agree to Terms & Conditions.
            </label>
       </div>

      </br>
        <div class="d-grid gap-2">
        <button class="btn btn-primary" type="submit">Register</button>
        </div>
</div>
</form>



</div>


<script>
   const phoneInputField = document.querySelector("#phone");
   const phoneInput = window.intlTelInput(phoneInputField, {
    preferredCountries: ["in", "co", "us", "de"],
     utilsScript:
       "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
   });
 </script>
