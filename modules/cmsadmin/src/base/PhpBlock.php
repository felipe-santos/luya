<?php

namespace cmsadmin\base;

use Yii;
use yii\base\ViewContextInterface;

/**
 * Represents a CMS block with PHP views.
 * 
 * @property \luya\web\View $view View Object.
 * 
 * @since 1.0.0-beta8
 * @author Basil Suter <basil@nadar.io>
 */
abstract class PhpBlock extends InternalBaseBlock implements PhpBlockInterface, ViewContextInterface
{
    private $_view = null;
    
    /**
     * View Object getter.
     * 
     * @return object|mixed
     */
    public function getView()
    {
        if ($this->_view === null) {
            $this->_view = Yii::createObject(PhpBlockView::className());
        }
        
        return $this->_view;
    }
    
    /**
     * {@inheritDoc}
     * @see \cmsadmin\base\PhpBlockInterface::frontend()
     */
    public function frontend()
    {
        $moduleName = $this->module;
        if (substr($moduleName, 0, 1) !== '@') {
            $moduleName = '@'.$moduleName;
        }
        
        return $this->view->render($this->getViewFileName('php'), [], $this);
    }
    
    /**
     * {@inheritDoc}
     * @see \cmsadmin\base\BlockInterface::renderFrontend()
     */
    public function renderFrontend()
    {
        return $this->frontend();
    }
    
    /**
     * {@inheritDoc}
     * @see \cmsadmin\base\BlockInterface::renderAdmin()
     */
    public function renderAdmin()
    {
        return $this->admin();
    }
}