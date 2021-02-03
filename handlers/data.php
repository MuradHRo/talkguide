<?php

class dataFetch{
    private $connection;
    private $tableName;
    private $page;
    private $limit;
    public function __construct($connection,$tableName,$limit,$page){
        $this->connection = $connection;
        $this->tableName = $tableName;
        $this->page= $page;
        $this->limit= $limit;

    }
    public function getData(){
        $start = ($this->page - 1) * $this->limit;
        $rows = $this->connection->query("SElECT * FROM $this->tableName LIMIT $start, $this->limit");
        $data = $rows->fetch_all(MYSQLI_ASSOC);
               

        $str ="";
        if(isset($_SESSION["username"])){
            if($this->tableName == "verb"){
                foreach($data as $item){
                    $form1 = $item["Form1"];
                    $form2 = $item["Form2"];
                    $form3 = $item["Form3"];
                    $form4 = $item["Form4"];
                    $arabic = $item["Arabic"];
                    $id = $item["id"];
                    $str .= "<tr>
                    <td>$form1</td>
                    <td>$form2</td>
                    <td>$form3</td>
                    <td>$form4</td>
                    <td>$arabic</td>
                    <td><button class='del_word' id='$this->tableName.$id'>X</button></td>
                    

                </tr>";
                }
            }else{
                foreach($data as $item){
                    $norwegian = $item["Norwegian"];
                    $arabic = $item["Arabic"];
                    $id = $item["id"];
                    $str .= "<tr>
                    <td>$norwegian</td>
                    <td>$arabic</td>
                    <td><button class='del_word' id='$this->tableName.$id'>X</button></td>


        
                </tr>";
                }
            }
        }else{
            if($this->tableName == "verb"){
                foreach($data as $item){
                    $form1 = $item["Form1"];
                    $form2 = $item["Form2"];
                    $form3 = $item["Form3"];
                    $form4 = $item["Form4"];
                    $arabic = $item["Arabic"];
                    $str .= "<tr>
                    <td>$form1</td>
                    <td>$form2</td>
                    <td>$form3</td>
                    <td>$form4</td>
                    <td>$arabic</td>

                </tr>";
                }
            }else{
                foreach($data as $item){
                    $norwegian = $item["Norwegian"];
                    $arabic = $item["Arabic"];

                    $str .= "<tr>
                    <td>$norwegian</td>
                    <td>$arabic</td>

        
                </tr>";
                }
            }
        }
        echo $str;
    }
    public function getPagesNumber(){
        $counter =$this->connection->query("SELECT count(id) AS id FROM $this->tableName");
        $wordnum = $counter->fetch_all(MYSQLI_ASSOC);
        $total = $wordnum[0]["id"];
        $pages =ceil($total/$this->limit);
         
        $previous = $this->page - 1;
        $next = $this->page + 1;
        $previousDisabled= ($previous == 0)? "disabled":"";
        $nextDisabled = ($next == $pages+1)? "disabled" : "";
        
        $pageNum ="";
        if($this->page > 1 && $this->page <= $pages - 1){
            ($this->page>2)?$pageNum .= "<li class='page-item'><a class='page-link'>...</a></li>":"";
            for($i=$this->page -1;$i<=$this->page+1;$i++){
                
                if($i == $this->page){
                $pageNum .= "<li class='page-item active'><a href='javascript:loadWords($i)' class='page-link'>$i</a></li>";
                }else{
                $pageNum .= "<li class='page-item'><a href='javascript:loadWords($i)' class='page-link'>$i</a></li>";
                }

            }
            ($this->page<$pages - 1)?$pageNum .= "<li class='page-item'><a class='page-link'>...</a></li>":"";
        }elseif($this->page == 1){
            for($i=1;$i<=$pages;$i++){
                $count ++;
                if($i == $this->page){
                $pageNum .= "<li class='page-item active'><a href='javascript:loadWords($i)' class='page-link'>$i</a></li>";
                }else{
                $pageNum .= "<li class='page-item'><a href='javascript:loadWords($i)' class='page-link'>$i</a></li>";
                }
                if($count == 3){
                    break;
                }
            }
            ($pages > 3)?$pageNum .= "<li class='page-item'><a class='page-link'>...</a></li>":"";
        }elseif($this->page == $pages){
            ($pages > 3)?$pageNum .= "<li class='page-item'><a class='page-link'>...</a></li>":"";
            if($pages > 3){
                for($i=$this->page - 2;$i <=$this->page; $i++ ){
                    if($i == $this->page){
                    $pageNum .= "<li class='page-item active'><a href='javascript:loadWords($i)' class='page-link'>$i</a></li>";
                    }else{
                    $pageNum .= "<li class='page-item'><a href='javascript:loadWords($i)' class='page-link'>$i</a></li>";
                    }
                }
            }else{
                for($i=1;$i <=2; $i++ ){
                    if($i == $this->page){
                    $pageNum .= "<li class='page-item active'><a href='javascript:loadWords($i)' class='page-link'>$i</a></li>";
                    }else{
                    $pageNum .= "<li class='page-item'><a href='javascript:loadWords($i)' class='page-link'>$i</a></li>";
                    }
                }
            }
            
        }
        echo "<li class='page-item $previousDisabled'><a href='javascript:loadWords($previous)' class='page-link'>Previous</a></li>".$pageNum."<li class='page-item $nextDisabled'><a href='javascript:loadWords($next)' class='page-link'>Next</a></li>";

    }
    public function getSearchData($pattern){
        $start = ($this->page - 1) * $this->limit;
        if($this->tableName == "verb"){
        $rows = $this->connection->query("SElECT * FROM $this->tableName WHERE Form1 LIKE '%$pattern%' OR Form2 LIKE '%$pattern%' OR Form3 LIKE '%$pattern%' OR Form4 LIKE '%$pattern%' OR Arabic LIKE '%$pattern%' LIMIT $start, $this->limit ");
        }else{
            $rows = $this->connection->query("SElECT * FROM $this->tableName WHERE Norwegian LIKE '%$pattern%' OR Arabic LIKE '%$pattern%' LIMIT $start, $this->limit ");
        }
        $data = $rows->fetch_all(MYSQLI_ASSOC);
        $str ="";
        if(empty($data)){
            $message = '<h1 class="text-center text-danger error_box" style="direction:rtl;">نعتذر عن عدم وجود على الكلمة :/<br> قم بالضعط بالأسفل لإرسال الكلمة إلى الإدارة <br> وحاول مجددًا خلال 24 ساعة</h1>';
            $formBox = '<form method="GET" onsubmit="sendWords(e);" style="flex-direction:column;direction:rtl;" class="error_box mb-5 w-50"><input type="text" class="form-control mb-3" name="word" placeholder="برجاء كتابة الكلمة هنا"><input type="text" class="form-control mb-3" name="emailWord" placeholder="البريد الإلكتروني(إن وجد)"><input type="text" class="form-control mb-3" name="notes" placeholder="ملاحظات(إن وجدت)"><input class="btn btn-success error_box_btn" type="submit" value="إرسال" name="sendWord"></form>';
            $returned =$message . $formBox ;
           

            $str ="<script> $('.notFoundDiv').html('$returned'); $('.table-head,.pagination,#filterForm').hide(); sendWords(); $('.notFoundDiv').css('height','50vh'); </script>";
            echo $str;
            
        }else{
            if(isset($_SESSION["username"])){
                if($this->tableName == "verb"){
                    foreach($data as $item){
                        $form1 = $item["Form1"];
                        $form2 = $item["Form2"];
                        $form3 = $item["Form3"];
                        $form4 = $item["Form4"];
                        $arabic = $item["Arabic"];
                        $id = $item["id"];
                        $str .= "<tr>
                        <td>$form1</td>
                        <td>$form2</td>
                        <td>$form3</td>
                        <td>$form4</td>
                        <td>$arabic</td>
                        <td><button class='del_word' id='$this->tableName.$id'>X</button></td>
                        
    
                    </tr>";
                    }
                }else{
                    foreach($data as $item){
                        $norwegian = $item["Norwegian"];
                        $arabic = $item["Arabic"];
                        $id = $item["id"];
                        $str .= "<tr>
                        <td>$norwegian</td>
                        <td>$arabic</td>
                        <td><button class='del_word' id='$this->tableName.$id'>X</button></td>

    
            
                    </tr>";
                    }
                }
            }else{
                if($this->tableName == "verb"){
                    foreach($data as $item){
                        $form1 = $item["Form1"];
                        $form2 = $item["Form2"];
                        $form3 = $item["Form3"];
                        $form4 = $item["Form4"];
                        $arabic = $item["Arabic"];
                        $str .= "<tr>
                        <td>$form1</td>
                        <td>$form2</td>
                        <td>$form3</td>
                        <td>$form4</td>
                        <td>$arabic</td>
    
                    </tr>";
                    }
                }else{
                    foreach($data as $item){
                        $norwegian = $item["Norwegian"];
                        $arabic = $item["Arabic"];
    
                        $str .= "<tr>
                        <td>$norwegian</td>
                        <td>$arabic</td>
    
            
                    </tr>";
                    }
                }
            }    
            $str .= "<script> $('.table-head,.pagination,#filterForm').show(); $('.error_box').remove() ;  $('.notFoundDiv').css('height','0'); </script>" ;
            echo $str;
        }


        

    }
    public function getSearchPagesNumber($pattern,$x){
        if($this->tableName == "verb"){
        $counter =$this->connection->query("SELECT count(id) AS id FROM verb WHERE Form1 LIKE '%$pattern%' OR Form2 LIKE '%$pattern%' OR Form3 LIKE '%$pattern%' OR Form4 LIKE '%$pattern%' OR Arabic LIKE '%$pattern%'" );
        }else{
            $counter =$this->connection->query("SELECT count(id) AS id FROM $this->tableName WHERE Norwegian LIKE '%$pattern%' OR Arabic LIKE '%$pattern%'" );
        }
        $wordnum = $counter->fetch_all(MYSQLI_ASSOC);
        $total = $wordnum[0]["id"];
        $pages =ceil($total/$this->limit);
         
        $previous = $x - 1;
        $next = $x + 1;
        $previousDisabled= ($previous == 0)? "disabled":"";
        $nextDisabled = ($next == $pages+1)? "disabled" : "";
        $pageNum ="";
        $count = 0;
        
        if($x > 1 && $x <= $pages - 1){
            ($x>2)?$pageNum .= "<li class='page-item'><a class='page-link'>...</a></li>":"";
            for($i=$x -1;$i<=$x+1;$i++){
                
                if($i == $x){
                $pageNum .= "<li class='page-item active'><a href='javascript:loadWords($i)' class='page-link'>$i</a></li>";
                }else{
                $pageNum .= "<li class='page-item'><a href='javascript:loadWords($i)' class='page-link'>$i</a></li>";
                }

            }
            ($x<$pages - 1)?$pageNum .= "<li class='page-item'><a class='page-link'>...</a></li>":"";
        }elseif($x == 1){
            for($i=1;$i<=$pages;$i++){
                $count ++;
                if($i == $x){
                $pageNum .= "<li class='page-item active'><a href='javascript:loadWords($i)' class='page-link'>$i</a></li>";
                }else{
                $pageNum .= "<li class='page-item'><a href='javascript:loadWords($i)' class='page-link'>$i</a></li>";
                }
                if($count == 3){
                    break;
                }
            }
            ($pages > 3)?$pageNum .= "<li class='page-item'><a class='page-link'>...</a></li>":"";
        }elseif($x == $pages){
            ($pages > 3)?$pageNum .= "<li class='page-item'><a class='page-link'>...</a></li>":"";
            if($pages >= 3){
                for($i=$x - 2;$i <=$x; $i++ ){
                    if($i == $x){
                    $pageNum .= "<li class='page-item active'><a href='javascript:loadWords($i)' class='page-link'>$i</a></li>";
                    }else{
                    $pageNum .= "<li class='page-item'><a href='javascript:loadWords($i)' class='page-link'>$i</a></li>";
                    }
                }
            }else{
                for($i=1;$i <=2; $i++ ){
                    if($i == $x){
                    $pageNum .= "<li class='page-item active'><a href='javascript:loadWords($i)' class='page-link'>$i</a></li>";
                    }else{
                    $pageNum .= "<li class='page-item'><a href='javascript:loadWords($i)' class='page-link'>$i</a></li>";
                    }
                }
            }
            
        }
        echo "<li class='page-item $previousDisabled'><a href='javascript:loadWords($previous)' class='page-link'>Previous</a></li>".$pageNum."<li class='page-item $nextDisabled'><a href='javascript:loadWords($next)' class='page-link'>Next</a></li>";
    
        
    }
     

}

?>