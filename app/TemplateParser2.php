<?php
/**
 * Created by PhpStorm.
 * User: jomo
 * Date: 24/10/2018
 * Time: 15:41
 */

class TemplateParser2
{
    public function Email( $sTemplateName, $aPlaceholders, $aData )
    {
        $sReplacedHtml = '';
        try
        {
            if( !empty( $sTemplateName ) && !empty( $aPlaceholders ) && !empty( $aData ) )
            {
                $iCountPlaceholders = count( $aPlaceholders );
                $iCountData         = count( $aData );
                if( $iCountData !== $iCountPlaceholders )
                {
                    throw new Exception( 'Placeholders and data don\'t match' );
                }
                if( file_exists( $sTemplateName ) )
                {
                    $sHtml = file_get_contents( $sTemplateName );
                    for( $i = 0; $i < $iCountData; ++$i )
                    {
                        $sHtml = str_ireplace( $aPlaceholders[ $i ], $aData[ $i ], $sHtml );
                    }
                    $sReplacedHtml = $sHtml;

                }
            }
        }
        catch( Exception $oException )
        {
            // Log if desired.
        }
        return $sReplacedHtml;
    }
}

$aPlaceholders = array( '{{username}}', '{{password}}' );
$aData         = array( 'Why so pro', 'dontchangeme' );

$oParser = new ParseTemplate;
$sReplacedHtml = $oParser->Email( 'intemplate.html', $aPlaceholders, $aData );
file_put_contents( 'outtemplate.html', $sReplacedHtml );
