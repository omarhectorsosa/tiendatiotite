<?php
/**
 * This file is part of the FIREGENTO project.
 *
 * FireGento_Pdf is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License version 3 as
 * published by the Free Software Foundation.
 *
 * This script is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * PHP version 5
 *
 * @category  FireGento
 * @package   FireGento_Pdf
 * @author    FireGento Team <team@firegento.com>
 * @copyright 2013 FireGento Team (http://www.firegento.com)
 * @license   http://opensource.org/licenses/gpl-3.0 GNU General Public License, version 3 (GPLv3)
 * @version   $Id:$
 * @since     0.1.0
 */
/**
 * Invoice model rewrite.
 *
 * The invoice model serves as a proxy to the actual PDF engine as set via
 * backend configuration.
 *
 * @category  FireGento
 * @package   FireGento_Pdf
 * @author    FireGento Team <team@firegento.com>
 * @copyright 2013 FireGento Team (http://www.firegento.com)
 * @license   http://opensource.org/licenses/gpl-3.0 GNU General Public License, version 3 (GPLv3)
 * @version   $Id:$
 * @since     0.1.0
 */
class FireGento_Pdf_Model_Invoice
{

    /**
     * The actual PDF engine responsible for rendering the file.
     *
     * @var Mage_Sales_Model_Order_Pdf_Abstract
     */
    private $_engine;

    /**
     * get pdf rendering engine
     *
     * @return Mage_Sales_Model_Order_Pdf_Abstract|Mage_Sales_Model_Order_Pdf_Invoice
     */
    protected function getEngine()
    {
        if (!$this->_engine) {
            $modelClass = Mage::getStoreConfig('sales_pdf/invoice/engine');
            $engine = Mage::getModel($modelClass);

            if (!$engine) {
                // Fallback to Magento standard invoice layout.
                $engine = new Mage_Sales_Model_Order_Pdf_Invoice();
            }

            $this->_engine = $engine;
        }

        return $this->_engine;
    }

    /**
     * get pdf for invoices
     *
     * @param  array|Varien_Data_Collection $invoices invoices to render pdfs for
     *
     * @return mixed
     */
    public function getPdf($invoices = array())
    {
        return $this->getEngine()->getPdf($invoices);
    }

}
