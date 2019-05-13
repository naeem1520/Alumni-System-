<?php
include "db_Class.php";
$obj = new db_class();
$obj->MySQL();
?>               




               <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>AUTHOR</th>
                  <th>CO-AUTHORS</th>
                  <th>TITLE</th>
                  <th>JOURNAL</th>
                  <th>CLUSTER</th>
                   <th>TYPE</th>
                   <th>YEAR</th>
                   <th>Journal</th>
                   <th>Proc</th>
                   <th>Non-Index</th>
                   <th>Book</th>
                   <th>Book-C</th>
                   <th>Policy</th>
                   <th>Other</th>
                   
                     <th>Link</th>
                </tr>
                </thead>
                <tbody>
             <?php  

  $SQL="select * from tb_paper";    //table name
  $results = $obj->sql($SQL);
  while($row = mysql_fetch_array($results))
  {

?>

            <tr>
              <td><?php echo $row['author']; ?></td>
              <td><?php echo $row['co_author']; ?></td>
              <td><?php echo $row['title']; ?></td>
              <td><?php echo $row['source']; ?></td>
              <td><?php echo $row['cluster']; ?></td>
              <td><?php echo $row['category']; ?></td>
              <td><?php echo $row['year']; ?></td>
                            
                            <td><?php echo $row['index_journal']; ?></td>
                            <td><?php echo $row['index_proc']; ?></td>
                            <td><?php echo $row['non_index']; ?></td>
                            <td><?php echo $row['book_research']; ?></td>
                            <td><?php echo $row['book_chapter']; ?></td>
                            <td><?php echo $row['paper_policy']; ?></td>
                            <td><?php echo $row['other']; ?></td>
                            
                       
                            <td><a href="<?php echo $row['link']; ?>">Link</a></td>
                            
                    
            </tr>
<?php
}
?>
                </tbody>             
              </table>