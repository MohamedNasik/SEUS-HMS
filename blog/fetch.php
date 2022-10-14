      
      <div class="row">
      <div class="col-sm-6 col-md-6 col-lg-4">
                        <div class="blog grid-blog">
                            <div class="blog-image">
                                <a href="blog-details.php"><img class="img-fluid" src='.$image.'    alt="" ></a>
                            </div>
                            <div class="blog-content">
                                <h3 class="blog-title"><a href="blog-details.php"><?php echo $title ?></a></h3>
                                <p> '. $word= 'Lorem ipsum dolor sit amet, consectetur em adipiscing elit, sed do eiusmod tempor incididunt ut labore etmis dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco sit laboris.';
                                echo substr($word,0, 160 ); '                              
                                
                                </p>
                             <small>   <a href="#."><i class="fa fa-user">  </i> <span>   '. $username .'  </span></a>   </small>
                                <a href="blog-details.php" class="read-more"><i class="fa fa-long-arrow-right"></i> Read More</a>
                                <div class="blog-info clearfix">
                                    <div class="post-left">
                                        <ul>
                                            <li><a href="#."><i class="fa fa-calendar"></i> <span>   '.  $created_at .'  </span></a></li>
                                        </ul>
                                    </div>
                                    <div class="post-right"><a href="#."><i class="fa fa-heart-o"></i>21</a>   <a href="#."><i class="fa fa-comment-o"></i>17</a> <a href="#."><i class="fa fa-trash-o"></i></a> <a href="#."><i class="fa fa-pen-o"></i></a></div>
                                </div>
                            </div>
                        </div>
                    </div>              
         </div>
                       