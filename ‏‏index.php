



<!DOCTYPE html>
<html lang="en">

<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    form {
      margin: 0em 30em;
      /* width: 30%; */
      text-align: right;
      background-color: #f4ede5;
      padding: 2em;
    }
    input {
    width: 80%;
}
  </style>
</head>

<body>
  <br><br>
  <form action="" method='post'>
    <div>
      <label class="form-label">URL :</label>
      <input type="text" placeholder="example:https://XXXX.com" name="url">
    </div>
    <div>
      <label class="form-label">Doctype :</label>
      <input type="text" placeholder="Enter Doctype" name="doc">
    </div>
    <div>
      <label class="form-label">Access key :</label>
      <input type="text" placeholder="Enter Access key" name="access">
    </div>
    <div class="mb-3">
      <label class="form-label">Secret key :</label>
      <input type="password" placeholder="Enter Secret key" name="secret">
    </div>
    <button type="submit" name='send' class="btn btn-warning">Submit</button>
  </form>
  <br><br>
  <div class="container row">
  <?php

if(isset($_POST['send']))
{
    $access=$_POST['access'];
    $secret=$_POST['secret'];
    $url=$_POST['url'];
    $doc=$_POST['doc'];
    $curl_handle = curl_init();

    $url = "$url/api/resource/$doc";
    curl_setopt($curl_handle, CURLOPT_HTTPHEADER, array(
      "Authorization:token $access:$secret"
    ));
    // Set the curl URL option
    curl_setopt($curl_handle, CURLOPT_URL, $url);

    // This option will return data as a string instead of direct output
    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);

    // Execute curl & store data in a variable
    $curl_data = curl_exec($curl_handle);

    curl_close($curl_handle);

    // Decode JSON into PHP array
    $response_data = json_decode($curl_data);

    // Print all data if needed
    // print_r($response_data);
    // die();

    // All item data exists in 'data' object
    $resulte = $response_data->data;

        foreach ($resulte as $row) {

          echo "<div class='card col-4'>
                    <div class='card-body'>
                      <h4 class='card-title'>Name : $row->name</h4>
                      </div></div>";
        }

      }
    ?>


  </div>

</body>

</html>