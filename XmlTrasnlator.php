<?php

class XmlTrasnlator {

    private $_xml = "";
    private $_xsd = "schema_special.xsd";
    private $_xsl = "xslt_special.xslt";

    function __construct($xml) {
        $this->_xml = $xml;
    }

    public function load() {
        /* $xmlDom = new DOMDocument();
          $xml = $xmlDom->load($this->_xml);
          print_r($xmlDom->saveXML); */

        $xml = new DOMDocument();
        $xml->load(($this->_xml));

        $x = $xml->documentElement;
        foreach ($x->childNodes AS $item) {
            print $item->nodeName . " = " . $item->nodeValue . "<br>";
        }

        //print_r($xml);
    }

    function validateAgainstXsd() {
        print "Start validation against xsd\n";
        $xml = new DOMDocument();
        $xml->load($this->_xml);
        if (!$xml->schemaValidate($this->_xsd)) {
            $errors = libxml_get_errors();
            foreach ($errors as $error) {
                print libxml_display_error($error);
            }
            libxml_clear_errors();
        } else {
            print "validation successful\n";
        }
    }

    function loadSX() {
        $xml = simplexml_load_file($this->_xml);
        $newDoc = new DOMDocument();
        $products = $newDoc->createElement("Allitems");

        foreach ($xml as $product) {
            $domDoc = new DOMDocument();
            $domDoc->loadXML($product->asXML());
            $x = $domDoc->documentElement;
            if (!$domDoc->schemaValidate($this->_xsd)) {
                $errors = libxml_get_errors();
                foreach ($errors as $error) {
                    //print libxml_display_error($error);
                }
                libxml_clear_errors();
            } else {
                print "validation successful\n";
                $item = $newDoc->createElement("Item");
                $i = 1;              
                foreach ($x->childNodes as $ele) {
                    if(! ($ele instanceof DOMElement)){
                        continue;
                    }
                    $nodeData = $newDoc->createElement(trim($ele->nodeName), $ele->nodeValue);
                    $item->appendChild($nodeData);
                }
                $products->appendChild($item);
                $newDoc->appendChild($products);
                $newDoc->formatOutput = true;
                print $newDoc->saveXML();
            }
        }
        print_r($newDoc->saveXML());
    }

}
