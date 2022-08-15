<div class="container">

<table class="table">
  <thead>
    <tr>
      <!-- <th scope="col">#</th> -->
      <th scope="col">Event name</th>
      <th scope="col">Start</th>
      <th scope="col">End</th>
    </tr>
  </thead>
  <tbody>
    
    <?php foreach ($events as $key => $event):?>
        <tr>
        <!-- <th scope="row"><?php// echo $key;?></th> -->
        <td> 
          <a href="<?php echo site_url('dashboard/event_details/'.$event['slug']);?>"> <?php echo $event['event_name'];?></a>
        </td>
        <td><?php echo $event['start_date'];?></td>
        <td><?php echo $event['end_date'];?></td>
    </tr>
    <?php endforeach;?>
  </tbody>
</table>

    </div>
    