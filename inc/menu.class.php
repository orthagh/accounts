<?php
/**
 * Configuration class for Davfi Plugin
 */
 
class PluginAccountsMenu extends CommonGLPI {
   static $rightname = 'config';

   static function canView() {
      //if ((static::$rightname) && (Session::haveRight(static::$rightname, READ))) {
      //   return TRUE;
      //}
      //   return FALSE;
      return true;
   }

   static function getMenuName() {
      return _n('Account', 'Accounts', 2, 'accounts');
   }

   static function getMenuContent() {
      global $CFG_GLPI;
      $menu          = array();
      $menu['title'] = self::getMenuName();
      $menu['page']  = "/plugins/accounts/front/account.php";
      $image = "<img src='".
            $CFG_GLPI["root_doc"]."/plugins/accounts/pics/cadenas.png' title='".
            _n('Encryption key', 'Encryption keys', 2)."' alt='"._n('Encryption key', 'Encryption keys', 2, 'accounts')."'>";
      
      $menu['options']['account']['title']           = PluginAccountsAccount::getTypeName(2);
      $menu['options']['account']['page']            = PluginAccountsAccount::getSearchURL(false);
      $menu['options']['account']['links']['search'] = PluginAccountsAccount::getSearchURL(false);
      if (PluginAccountsAccount::canCreate()) {
         $menu['options']['account']['links']['add'] = PluginAccountsAccount::getFormURL(false);
         $image = "<img src='".
               $CFG_GLPI["root_doc"]."/plugins/accounts/pics/cadenas.png' title='".
               _n('Encryption key', 'Encryption keys', 2)."' alt='"._n('Encryption key', 'Encryption keys', 2, 'accounts')."'>";
         $menu['options']['account']['links'][$image] = PluginAccountsHash::getSearchURL(false);
      }

      $menu['options']['hash']['title']           = PluginAccountsHash::getTypeName(2);
      $menu['options']['hash']['page']            = PluginAccountsHash::getSearchURL(false);
      $menu['options']['hash']['links']['search'] = PluginAccountsHash::getSearchURL(false);
      $menu['options']['hash']['links'][$image]   = PluginAccountsHash::getSearchURL(false);;

      if (PluginAccountsHash::canCreate()) {
         $menu['options']['hash']['links']['add'] = PluginAccountsHash::getFormURL(false);
      }

      return $menu;
   }


}