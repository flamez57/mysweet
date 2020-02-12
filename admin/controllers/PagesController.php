<?php
namespace admin\controllers;
/**
** @ClassName: PagesController
** @Description: 样品页面
** @author flamez57 <flamez57@mysweet95.com>
** @date 2020年2月12日 晚上21:49
** @version V1.0
*/
use hl\HLController;
use hl\HLView;

class PagesController extends HLController
{
    /*
    ** charts
    */
    public function chartjsAction()
    {
        HLView::param('title', 'chartjs');
    }

    public function flotAction()
    {
        HLView::param('title', 'flot');
    }

    public function inlineAction()
    {
        HLView::param('title', 'inline');
    }

    public function morrisAction()
    {
        HLView::param('title', 'morris');
    }

    /*
     * example
     */
    public function _404Action()
    {
        HLView::param('title', '404');
    }

    public function _500Action()
    {
        HLView::param('title', '500');
    }

    public function blankAction()
    {
        HLView::param('title', 'blank');
    }

    public function invoiceAction()
    {
        HLView::param('title', 'invoice');
    }

    public function invoicePrintAction()
    {
        HLView::param('title', 'invoicePrint');
    }

    public function lockscreenAction()
    {
        HLView::param('title', 'lockscreen');
    }

    public function loginAction()
    {
        HLView::param('title', 'login');
    }

    public function paceAction()
    {
        HLView::param('title', 'pace');
    }

    public function profileAction()
    {
        HLView::param('title', 'profile');
    }

    public function registerAction()
    {
        HLView::param('title', 'register');
    }

    /*
     * forms
     */
    public function advancedAction()
    {
        HLView::param('title', 'advanced');
    }

    public function editorsAction()
    {
        HLView::param('title', 'editors');
    }

    public function generalAction()
    {
        HLView::param('title', 'general');
    }

    /*
     * layout
     */
    public function boxedAction()
    {
        HLView::param('title', 'boxed');
    }

    public function collapsedSidebarAction()
    {
        HLView::param('title', 'collapsedSidebar');
    }

    public function fixedAction()
    {
        HLView::param('title', 'fixed');
    }

    public function topNavAction()
    {
        HLView::param('title', 'topNav');
    }

    /*
     * mailbox
     */
    public function composeAction()
    {
        HLView::param('title', 'compose');
    }

    public function mailboxAction()
    {
        HLView::param('title', 'mailbox');
    }

    public function readMailAction()
    {
        HLView::param('title', 'readMail');
    }

    /*
     * tables
     */
    public function dataAction()
    {
        HLView::param('title', 'data');
    }

    public function simpleAction()
    {
        HLView::param('title', 'simple');
    }

    /*
     * UI
     */
    public function buttonsAction()
    {
        HLView::param('title', 'buttons');
    }

    public function general2Action()
    {
        HLView::param('title', 'general');
    }

    public function iconsAction()
    {
        HLView::param('title', 'icons');
    }

    public function modalsAction()
    {
        HLView::param('title', 'modals');
    }

    public function slidersAction()
    {
        HLView::param('title', 'sliders');
    }

    public function timelineAction()
    {
        HLView::param('title', 'timeline');
    }

    public function calendarAction()
    {
        HLView::param('title', 'calendar');
    }
    public function widgetsAction()
    {
        HLView::param('title', 'widgets');
    }
}
