<style>
  .form-signin {
  max-width: 800px;
  padding: 15px;
}

body {
 
 
  background-color: #f5f5f5;
}
  </style>
<main class="form-signin m-auto">
  <h1>Add Event</h1>
<form method="POST" action="<?php echo base_url().'dashboard/createevent';?>" enctype="multipart/form-data">
  
  <label for="event_name" class="form-label">Event name</label>
  <input type="text" class="form-control" id="event_name" name="event_name">
  <label for="event_start_date" class="form-label">Start date</label>
  <input type="date" class="form-control" id="event_start_date" name="event_start_date">
  <label for="event_end_date" class="form-label">End date</label>
  <input type="date" class="form-control" id="event_end_date" name="event_end_date">
  <label for="event_start_time" class="form-label">Start time</label>
  <input type="time" class="form-control" id="event_start_time" name="event_start_time">
  <label for="event_end_time" class="form-label">End time</label>
  <input type="time" class="form-control" id="event_end_time" name="event_end_time">




  <label for="welcome_text" class="form-label">Welcom text</label>
  <textarea class="form-control" id="welcome_text" name="welcome_text" rows="3"></textarea>

  <label for="disclaimer" class="form-label">Disclaimer</label>
  <textarea class="form-control" id="disclaimer" name="disclaimer" rows="3"></textarea>

  <label for="email_body" class="form-label">Email body</label>
  <textarea class="form-control" id="email_body" name="email_body" rows="3"></textarea>

<div class="mb-3">
  <label for="banner" class="form-label">Upload banner image</label>
  <input class="form-control" type="file" id="banner" name="banner">
</div>

<div class="mb-3">
  <label for="email_header" class="form-label">Upload email header image</label>
  <input class="form-control" type="file" id="email_header" name="email_header">
</div>

<div class="mb-3">
  <label for="email_footer" class="form-label">Upload email footer image</label>
  <input class="form-control" type="file" id="email_footer" name="email_footer" >
</div>

<div class="mb-3">
  <label for="slug" class="form-label">URL/Slug</label>
  <input class="form-control" type="text" id="slug" name="slug" >
</div>

  <div class="d-grid gap-2">
  <button class="btn btn-primary" type="submit">Submit</button>
  
</div>

</form>

</main>
