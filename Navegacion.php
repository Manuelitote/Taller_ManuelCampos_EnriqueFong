<?php

class Navegacion
{ 
    public static function volverAlMenu($url = 'index.php')
    {
        echo '<div style="text-align: center; margin: 20px 0;">
                <a href="' . htmlspecialchars($url) . '" 
                   style="display: inline-block; 
                          background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%); 
                          color: white; 
                          padding: 12px 30px; 
                          text-decoration: none; 
                          border-radius: 10px; 
                          font-weight: bold;
                          transition: transform 0.2s;
                          box-shadow: 0 4px 15px rgba(255, 107, 107, 0.4);">
                    ⬅️ Volver al Menú Principal
                </a>
              </div>';
    }
}