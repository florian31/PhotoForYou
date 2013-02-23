
<div class="sidebar">
    
    <?php 
    if (isset($_SESSION['user']) AND $_SESSION['user']==10) 
        {
            echo '
            <ul>	
               <li>
                    <h3>Navigate</h3>
                    <ul class="blocklist">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="examples.html">Examples</a></li>
                        <li><a href="#">Products</a></li>
                        <li><a href="#">Solutions</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </li>
              </ul>   ';  
            
         }  
              else
              {
                  echo '
                <form action="index.php" method="post" accept-charset="utf-8">
                <p>
                    <label for="email">
                           <strong>Adresse e-mail</strong></label>
                            <br />
                    <input type="text" name="email" id="email" />
                    <br />
                    <label for="pass">
                        <strong>Mot de passe</strong>
                    </label>
                    <br />
                    <input type="password" name="pass" id="pass" /> 
                    <input type="submit" value="Login &rarr;"></p>
            </form> ';
            } 
     ?>         
        </div>

<div class="clear"></div>
    </div>

