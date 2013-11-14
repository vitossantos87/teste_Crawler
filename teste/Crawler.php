<?php

class Crawler {
    protected $url = "";
    protected $depth = 0;

    public function __construct($uri, $d) {

        $this->url = $uri;
        $this->depth = $d;
    }
    

    
    public function getLinks(){
       
        // domínio inicial
        $domain = $this->url;              
        // número máximo de URLs para checar
        $max_urls_to_check = $this->depth;
        
        $rounds = 0;
        // urls encontradas
        $domain_stack = array();
        // tamanha máximo do array de urls
        $max_size_domain_stack = 100;
        // hash dos domínios checados
        $checked_domains = array();

        
        while ($domain != "" && $rounds < $max_urls_to_check) {
            
            $doc = new DOMDocument();

            $doc->loadHTMLFile($domain);            
            
            $checked_domains[$domain] = true;
            
            foreach($doc->getElementsByTagName('a') as $link) {
                
                $href = $link->getAttribute('href');
                if (strpos($href, 'http://') !== false && strpos($href, $domain) === false) {
                    
                    $href_array = explode("/", $href);
                    // apenas acrescenta se o dominio não foi checado e se tem menos de 100 dominios
                    if (count($domain_stack) < $max_size_domain_stack &&                        
                       !isset( $checked_domains["http://".$href_array[2]])) {
                        array_push($domain_stack, "http://".$href_array[2]);
                    }
                }
            }

            // remove domínios duplicados
            $domain_stack = array_unique($domain_stack);
            $domain = $domain_stack[$rounds];
            $domain_stack = array_values($domain_stack);
            $rounds++;
        }

      echo "Domínios checados: <br/>";
      
      foreach ($checked_domains as $key => $value) {
            if ($value) {
                echo "&DoubleRightArrow; ".$key."<br/>";
            }
        }
        
        
       echo "<br/><br/>URLs encontradas<br/>";
        
        foreach ($domain_stack as $key ) {
            if ($key) {
                echo "&DoubleRightArrow; ".$key."<br/>";
            }
        }

       
    }
}

?>
