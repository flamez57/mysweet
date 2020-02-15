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
        HLView::param('active', 'chartjs');
    }

    public function flotAction()
    {
        HLView::param('title', 'flot');
        HLView::param('active', 'flot');
    }

    public function inlineAction()
    {
        HLView::param('title', 'inline');
        HLView::param('active', 'inline');
    }

    public function morrisAction()
    {
        HLView::param('title', 'morris');
        HLView::param('active', 'morris');
    }

    /*
     * example
     */
    public function _404Action()
    {
        HLView::param('title', '404');
        HLView::param('active', '_404');
    }

    public function _500Action()
    {
        HLView::param('title', '500');
        HLView::param('active', '_500');
    }

    public function blankAction()
    {
        HLView::param('title', 'blank');
        HLView::param('active', 'blank');
    }

    public function invoiceAction()
    {
        HLView::param('title', 'invoice');
        HLView::param('active', 'invoice');
    }

    public function invoicePrintAction()
    {
        HLView::param('title', 'invoicePrint');
        HLView::param('active', 'invoicePrint');
    }

    public function lockscreenAction()
    {
        HLView::param('title', 'lockscreen');
        HLView::param('active', 'lockscreen');
    }

    public function loginAction()
    {
        HLView::param('title', 'login');
        HLView::param('active', 'login');
    }

    public function paceAction()
    {
        HLView::param('title', 'pace');
        HLView::param('active', 'pace');
    }

    public function profileAction()
    {
        HLView::param('title', 'profile');
        HLView::param('active', 'profile');
    }

    public function registerAction()
    {
        HLView::param('title', 'register');
        HLView::param('active', 'register');
    }

    /*
     * forms
     */
    public function advancedAction()
    {
        HLView::param('title', 'advanced');
        HLView::param('active', 'advanced');
    }

    public function editorsAction()
    {
        HLView::param('title', 'editors');
        HLView::param('active', 'editors');
    }

    public function generalAction()
    {
        HLView::param('title', 'general');
        HLView::param('active', 'general');
    }

    /*
     * layout
     */
    public function boxedAction()
    {
        HLView::param('title', 'boxed');
        HLView::param('active', 'boxed');
    }

    public function collapsedSidebarAction()
    {
        HLView::param('title', 'collapsedSidebar');
        HLView::param('active', 'collapsedSidebar');
    }

    public function fixedAction()
    {
        HLView::param('title', 'fixed');
        HLView::param('active', 'fixed');
    }

    public function topNavAction()
    {
        HLView::param('title', 'topNav');
        HLView::param('active', 'topNav');
    }

    /*
     * mailbox
     */
    public function composeAction()
    {
        HLView::param('title', 'compose');
        HLView::param('active', 'compose');
    }

    public function mailboxAction()
    {
        HLView::param('title', 'mailbox');
        HLView::param('active', 'mailbox');
    }

    public function readMailAction()
    {
        HLView::param('title', 'readMail');
        HLView::param('active', 'readMail');
    }

    /*
     * tables
     */
    public function dataAction()
    {
        HLView::param('title', 'data');
        HLView::param('active', 'data');
    }

    public function simpleAction()
    {
        HLView::param('title', 'simple');
        HLView::param('active', 'simple');
    }

    /*
     * UI
     */
    public function buttonsAction()
    {
        HLView::param('title', 'buttons');
        HLView::param('active', 'buttons');
    }

    public function general2Action()
    {
        HLView::param('title', 'general');
        HLView::param('active', 'general2');
    }

    public function iconsAction()
    {
        HLView::param('title', 'icons');
        HLView::param('active', 'icons');
    }

    public function modalsAction()
    {
        HLView::param('title', 'modals');
        HLView::param('active', 'modals');
    }

    public function slidersAction()
    {
        HLView::param('title', 'sliders');
        HLView::param('active', 'sliders');
    }

    public function timelineAction()
    {
        HLView::param('title', 'timeline');
        HLView::param('active', 'timeline');
    }

    public function calendarAction()
    {
        HLView::param('title', 'calendar');
        HLView::param('active', 'calendar');
    }
    public function widgetsAction()
    {
        HLView::param('title', 'widgets');
        HLView::param('active', 'widgets');
    }
}
