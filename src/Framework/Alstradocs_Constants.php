<?php
namespace Enterprise\Framework;

/**
 * Just a bunch of constants for the app.
 * @author Edward Banfa <ebanfa@alstradocs.com>
 */
class Alstradocs_Constants
{
    /** Templates configuration respository */
    public static $templates_config_repo_token = "alstradocsUiTemplatesConfigurationRepository";

    /** Capabilities */
    public static $admin_user_capability = "manage_options";

    /** Template controllers configuration respository */
    public static $alstradocs_sign_in_form_config_repo_token = "alstradocsUiSignInFormConfigurationRepository";
    public static $alstradocs_sign_up_form_config_repo_token = "alstradocsUiSignUpFormConfigurationRepository";
    public static $template_controllers_config_token = "alstradocsUiTemplateControllersConfigurationRepository";

    /** Templates configuration respository */
    public static $actions_config_repo_token = "alstradocsActionsConfigurationRepository";

    /** Form Controllers */
    public static $alstradocs_form_controller = "alstradocsUiFormTemplateController";

    /** Generic Template Controller Executor Controller */
    public static $alstradocs_gtc_executor_controller = "alstradocsUiGTCExecutorController";
    public static $alstradocs_template_controller_shortcode = "alstradocsUiTemplateControllerShortcode";
    // Short code names
    public static $alstradocs_execute_template_shortcode_name = "alstradocs_execute_template_controller";


    /** Framework Templates */
    public static $admin_page_header_template = "alstradocsUiAdminPageHeaderTemplate";
    public static $admin_page_body_header_template = "alstradocsUiAdminPageBodyHeaderTemplate";
    public static $admin_page_body_template = "alstradocsUiAdminPageBodyTemplate";
    public static $admin_page_body_footer_template = "alstradocsUiAdminPageBodyFooterTemplate";
    public static $admin_page_footer_template = "alstradocsUiAdminPageFooterTemplate";
    public static $admin_data_list_template = "alstradocsUiAdminDataListTemplate";
    public static $admin_settings_page_template = "alstradocsUiAdminSettingsPageTemplate";
    public static $admin_settings_section_template = "alstradocsUiAdminSettingsSectionTemplate";
    public static $admin_settings_field_template = "alstradocsUiAdminSettingsFieldTemplate";

    /** Client user Templates */
    public static $alstradocs_form_start_template = "alstradocsUiFormStartTemplate";
    public static $alstradocs_form_end_template = "alstradocsUiFormEndTemplate";
    public static $alstradocs_form_section_start_template = "alstradocsUiFormSectionStartTemplate";
    public static $alstradocs_form_section_end_template = "alstradocsUiFormSectionEndTemplate";
    public static $alstradocs_form_field_group_start_template = "alstradocsUiFormFieldGroupStartTemplate";
    public static $alstradocs_form_field_group_end_template = "alstradocsUiFormFieldGroupEndTemplate";
    public static $alstradocs_form_field_start_template = "alstradocsUiFormFieldStartTemplate";
    public static $alstradocs_form_field_end_template = "alstradocsUiFormFieldEndTemplate";
    public static $alstradocs_form_field_template = "alstradocsUiFormFieldTemplate";
    public static $alstradocs_form_controls_template = "alstradocsUiFormControlsTemplate";

    /** Common Widget & Component Templates */
    public static $alstradocs_sign_in_form_view_controller = 'alstradocsSigninViewController';
    public static $alstradocs_sign_up_form_view_controller = 'alstradocsSignupViewController';
    public static $alstradocs_sign_in_form_view_template = 'alstradocsSigninViewTempllate';
    public static $alstradocs_sign_up_form_view_template = 'alstradocsSignupViewTemplate';



    /** Framework Query Filters */
}
