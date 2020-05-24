<?php
//fetch.php
if(isset($_POST["query"]))
{
 $connect = mysqli_connect("localhost", "root", "", "prolife");
 $request = mysqli_real_escape_string($connect, $_POST["query"]);
 $query = "
  SELECT * FROM doctor WHERE speciality LIKE '%".$request."%'
 ";
 $result = mysqli_query($connect, $query);
 $data =array();
 $html = '';
 $html .= '
  <table class="table table-bordered table-striped">
   <tr>
		<th width="30%"><h5 style = "color:blue;">Doctor Name</h5></th>  
        <th width="25%"><h5 style = "color:blue;">Speciality</h5></th>  
		<th width="15%"><h5 style = "color:blue;">Experience</h5></th>  
		<th width="15%"><h5 style = "color:blue;">Fees</h5></th>  
		<th width="5%"><h5 style = "color:blue;">Location<h5></th>
   </tr>
  ';
 if(mysqli_num_rows($result) > 0)
 {
  while($row = mysqli_fetch_array($result))
  {
   $data[] = $row["speciality"];
   $html .= '
	   <tr>
		<td><h5>'.$row["name"].'</h5></td>
		<td><h5>'.$row["speciality"].'</h5></td>
		<td><h5>'.$row["experience"].'yrs</h5></td>
		<td><h5>'.$row["fees"].' /-</h5></td>
		<td><h5>'.$row["location"].'</h5></td>
		<td><input type="submit" data-toggle="modal" data-target="#loginModal" name="book" id = '.$row["id"].' class="btn btn-info btn-xs book" value="Book"/></td>
	   </tr>
   ';
  }
 }
 else
 {
  $data = 'No Data Found';
  $html .= '
	<tr>
		<td colspan="3">No Data Found</td>
	</tr>
   ';
 }
 $html .= '</table>';
 if(isset($_POST['typehead_search']))
 {
  echo $html;
 }
 else
 {
  $data = array_unique($data);
  echo json_encode($data);
 }
}

?>