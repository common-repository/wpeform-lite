<?php

// autoload_classmap.php @generated by Composer

$vendorDir = dirname(__DIR__);
$baseDir = dirname($vendorDir);

return array(
    'Composer\\InstalledVersions' => $vendorDir . '/composer/InstalledVersions.php',
    'WPEForm\\Auth\\Base' => $baseDir . '/inc/Auth/Base.php',
    'WPEForm\\Auth\\Category' => $baseDir . '/inc/Auth/Category.php',
    'WPEForm\\Auth\\Dashboard' => $baseDir . '/inc/Auth/Dashboard.php',
    'WPEForm\\Auth\\Form' => $baseDir . '/inc/Auth/Form.php',
    'WPEForm\\Auth\\IAuth' => $baseDir . '/inc/Auth/IAuth.php',
    'WPEForm\\Auth\\SiteSettings' => $baseDir . '/inc/Auth/SiteSettings.php',
    'WPEForm\\Auth\\Submission' => $baseDir . '/inc/Auth/Submission.php',
    'WPEForm\\CoR\\AbstractMiddleware' => $baseDir . '/inc/CoR/AbstractMiddleware.php',
    'WPEForm\\CoR\\ICoR' => $baseDir . '/inc/CoR/ICoR.php',
    'WPEForm\\CoR\\Submission\\Base' => $baseDir . '/inc/CoR/Submission/Base.php',
    'WPEForm\\CoR\\Submission\\ConditionalsProcessor' => $baseDir . '/inc/CoR/Submission/ConditionalsProcessor.php',
    'WPEForm\\CoR\\Submission\\ElementsProcessor' => $baseDir . '/inc/CoR/Submission/ElementsProcessor.php',
    'WPEForm\\CoR\\Submission\\IntegrationsRunner' => $baseDir . '/inc/CoR/Submission/IntegrationsRunner.php',
    'WPEForm\\CoR\\Submission\\PermissionsPresaveMutationsRunner' => $baseDir . '/inc/CoR/Submission/PermissionsPresaveMutationsRunner.php',
    'WPEForm\\CoR\\Submission\\PermissionsSideEffectsRunner' => $baseDir . '/inc/CoR/Submission/PermissionsSideEffectsRunner.php',
    'WPEForm\\CoR\\Submission\\PostSubmissionLimitationsChecker' => $baseDir . '/inc/CoR/Submission/PostSubmissionLimitationsChecker.php',
    'WPEForm\\CoR\\Submission\\PreemptiveLimitationsProcessor' => $baseDir . '/inc/CoR/Submission/PreemptiveLimitationsProcessor.php',
    'WPEForm\\CoR\\Submission\\SettingsMutationsRunner' => $baseDir . '/inc/CoR/Submission/SettingsMutationsRunner.php',
    'WPEForm\\CoR\\Submission\\SettingsPreprocessor' => $baseDir . '/inc/CoR/Submission/SettingsPreprocessor.php',
    'WPEForm\\CoR\\Submission\\SettingsSideEffectsRunner' => $baseDir . '/inc/CoR/Submission/SettingsSideEffectsRunner.php',
    'WPEForm\\Config\\Delimiter' => $baseDir . '/inc/Config/Delimiter.php',
    'WPEForm\\Config\\ValueUsing' => $baseDir . '/inc/Config/ValueUsing.php',
    'WPEForm\\Controller\\Base' => $baseDir . '/inc/Controller/Base.php',
    'WPEForm\\Controller\\Category' => $baseDir . '/inc/Controller/Category.php',
    'WPEForm\\Controller\\Dashboard' => $baseDir . '/inc/Controller/Dashboard.php',
    'WPEForm\\Controller\\Form' => $baseDir . '/inc/Controller/Form.php',
    'WPEForm\\Controller\\SiteSettings' => $baseDir . '/inc/Controller/SiteSettings.php',
    'WPEForm\\Controller\\Submission' => $baseDir . '/inc/Controller/Submission.php',
    'WPEForm\\Editor\\Block' => $baseDir . '/inc/Editor/Block.php',
    'WPEForm\\Editor\\Shortcode' => $baseDir . '/inc/Editor/Shortcode.php',
    'WPEForm\\Exception\\AuthException' => $baseDir . '/inc/Exception/AuthException.php',
    'WPEForm\\Exception\\InsufficientPermissionException' => $baseDir . '/inc/Exception/InsufficientPermissionException.php',
    'WPEForm\\Exception\\InvalidConfigException' => $baseDir . '/inc/Exception/InvalidConfigException.php',
    'WPEForm\\Exception\\InvalidCrudOperationException' => $baseDir . '/inc/Exception/InvalidCrudOperationException.php',
    'WPEForm\\Exception\\InvalidElementException' => $baseDir . '/inc/Exception/InvalidElementException.php',
    'WPEForm\\Exception\\InvalidEndpointException' => $baseDir . '/inc/Exception/InvalidEndpointException.php',
    'WPEForm\\Exception\\InvalidFieldVarException' => $baseDir . '/inc/Exception/InvalidFieldVarException.php',
    'WPEForm\\Exception\\InvalidGraphQLRegistryException' => $baseDir . '/inc/Exception/InvalidGraphQLRegistryException.php',
    'WPEForm\\Exception\\InvalidIntegrationException' => $baseDir . '/inc/Exception/InvalidIntegrationException.php',
    'WPEForm\\Exception\\InvalidOperationException' => $baseDir . '/inc/Exception/InvalidOperationException.php',
    'WPEForm\\Exception\\InvalidPaginationException' => $baseDir . '/inc/Exception/InvalidPaginationException.php',
    'WPEForm\\Exception\\ModelOperationException' => $baseDir . '/inc/Exception/ModelOperationException.php',
    'WPEForm\\Exception\\ResourceDoesNotExistException' => $baseDir . '/inc/Exception/ResourceDoesNotExistException.php',
    'WPEForm\\Exception\\SubmissionValidationException' => $baseDir . '/inc/Exception/SubmissionValidationException.php',
    'WPEForm\\Exception\\ValidationException' => $baseDir . '/inc/Exception/ValidationException.php',
    'WPEForm\\Factory\\Form\\Config\\Base' => $baseDir . '/inc/Factory/Form/Config/Base.php',
    'WPEForm\\Factory\\Form\\Config\\Integrations' => $baseDir . '/inc/Factory/Form/Config/Integrations.php',
    'WPEForm\\Factory\\Form\\Config\\Payments' => $baseDir . '/inc/Factory/Form/Config/Payments.php',
    'WPEForm\\Factory\\Form\\Config\\Permissions' => $baseDir . '/inc/Factory/Form/Config/Permissions.php',
    'WPEForm\\Factory\\Form\\Config\\Settings' => $baseDir . '/inc/Factory/Form/Config/Settings.php',
    'WPEForm\\Factory\\Form\\Config\\Styles' => $baseDir . '/inc/Factory/Form/Config/Styles.php',
    'WPEForm\\Factory\\Form\\Elements' => $baseDir . '/inc/Factory/Form/Elements.php',
    'WPEForm\\Factory\\Role' => $baseDir . '/inc/Factory/Role.php',
    'WPEForm\\Form\\Config\\Base' => $baseDir . '/inc/Form/Config/Base.php',
    'WPEForm\\Form\\Config\\IConfig' => $baseDir . '/inc/Form/Config/IConfig.php',
    'WPEForm\\Form\\Config\\Integrations\\Base' => $baseDir . '/inc/Form/Config/Integrations/Base.php',
    'WPEForm\\Form\\Config\\Integrations\\IIntegrations' => $baseDir . '/inc/Form/Config/Integrations/IIntegrations.php',
    'WPEForm\\Form\\Config\\Integrations\\MailChimp' => $baseDir . '/inc/Form/Config/Integrations/MailChimp.php',
    'WPEForm\\Form\\Config\\Payments\\Base' => $baseDir . '/inc/Form/Config/Payments/Base.php',
    'WPEForm\\Form\\Config\\Payments\\General' => $baseDir . '/inc/Form/Config/Payments/General.php',
    'WPEForm\\Form\\Config\\Payments\\IPayments' => $baseDir . '/inc/Form/Config/Payments/IPayments.php',
    'WPEForm\\Form\\Config\\Payments\\Offline' => $baseDir . '/inc/Form/Config/Payments/Offline.php',
    'WPEForm\\Form\\Config\\Permissions\\AccessPermission' => $baseDir . '/inc/Form/Config/Permissions/AccessPermission.php',
    'WPEForm\\Form\\Config\\Permissions\\Base' => $baseDir . '/inc/Form/Config/Permissions/Base.php',
    'WPEForm\\Form\\Config\\Permissions\\IPermissions' => $baseDir . '/inc/Form/Config/Permissions/IPermissions.php',
    'WPEForm\\Form\\Config\\Permissions\\SubmissionPermission' => $baseDir . '/inc/Form/Config/Permissions/SubmissionPermission.php',
    'WPEForm\\Form\\Config\\Settings\\AdminNotification' => $baseDir . '/inc/Form/Config/Settings/AdminNotification.php',
    'WPEForm\\Form\\Config\\Settings\\Base' => $baseDir . '/inc/Form/Config/Settings/Base.php',
    'WPEForm\\Form\\Config\\Settings\\ISettings' => $baseDir . '/inc/Form/Config/Settings/ISettings.php',
    'WPEForm\\Form\\Config\\Settings\\Score' => $baseDir . '/inc/Form/Config/Settings/Score.php',
    'WPEForm\\Form\\Config\\Settings\\Timer' => $baseDir . '/inc/Form/Config/Settings/Timer.php',
    'WPEForm\\Form\\Config\\Settings\\UserData' => $baseDir . '/inc/Form/Config/Settings/UserData.php',
    'WPEForm\\Form\\Config\\Settings\\UserNotification' => $baseDir . '/inc/Form/Config/Settings/UserNotification.php',
    'WPEForm\\Form\\Config\\Styles\\Appearance' => $baseDir . '/inc/Form/Config/Styles/Appearance.php',
    'WPEForm\\Form\\Config\\Styles\\CustomBackground' => $baseDir . '/inc/Form/Config/Styles/CustomBackground.php',
    'WPEForm\\Form\\Config\\Styles\\FormBehavior' => $baseDir . '/inc/Form/Config/Styles/FormBehavior.php',
    'WPEForm\\Form\\Config\\Styles\\Pagination' => $baseDir . '/inc/Form/Config/Styles/Pagination.php',
    'WPEForm\\Form\\Config\\Styles\\Redirection' => $baseDir . '/inc/Form/Config/Styles/Redirection.php',
    'WPEForm\\Form\\Config\\Styles\\Theme' => $baseDir . '/inc/Form/Config/Styles/Theme.php',
    'WPEForm\\Form\\Config\\Styles\\Tracking' => $baseDir . '/inc/Form/Config/Styles/Tracking.php',
    'WPEForm\\Form\\Config\\Styles\\Typography' => $baseDir . '/inc/Form/Config/Styles/Typography.php',
    'WPEForm\\Form\\Element\\Address' => $baseDir . '/inc/Form/Element/Address.php',
    'WPEForm\\Form\\Element\\Base' => $baseDir . '/inc/Form/Element/Base.php',
    'WPEForm\\Form\\Element\\Buttons' => $baseDir . '/inc/Form/Element/Buttons.php',
    'WPEForm\\Form\\Element\\Captcha' => $baseDir . '/inc/Form/Element/Captcha.php',
    'WPEForm\\Form\\Element\\Checkbox' => $baseDir . '/inc/Form/Element/Checkbox.php',
    'WPEForm\\Form\\Element\\Column' => $baseDir . '/inc/Form/Element/Column.php',
    'WPEForm\\Form\\Element\\DateTimeInput' => $baseDir . '/inc/Form/Element/DateTimeInput.php',
    'WPEForm\\Form\\Element\\Dropdown' => $baseDir . '/inc/Form/Element/Dropdown.php',
    'WPEForm\\Form\\Element\\Group' => $baseDir . '/inc/Form/Element/Group.php',
    'WPEForm\\Form\\Element\\Heading' => $baseDir . '/inc/Form/Element/Heading.php',
    'WPEForm\\Form\\Element\\IElement' => $baseDir . '/inc/Form/Element/IElement.php',
    'WPEForm\\Form\\Element\\MathCalc' => $baseDir . '/inc/Form/Element/MathCalc.php',
    'WPEForm\\Form\\Element\\MathCalcGroup' => $baseDir . '/inc/Form/Element/MathCalcGroup.php',
    'WPEForm\\Form\\Element\\MatrixChoice' => $baseDir . '/inc/Form/Element/MatrixChoice.php',
    'WPEForm\\Form\\Element\\MatrixInput' => $baseDir . '/inc/Form/Element/MatrixInput.php',
    'WPEForm\\Form\\Element\\Radio' => $baseDir . '/inc/Form/Element/Radio.php',
    'WPEForm\\Form\\Element\\Range' => $baseDir . '/inc/Form/Element/Range.php',
    'WPEForm\\Form\\Element\\RangeGroup' => $baseDir . '/inc/Form/Element/RangeGroup.php',
    'WPEForm\\Form\\Element\\Rating' => $baseDir . '/inc/Form/Element/Rating.php',
    'WPEForm\\Form\\Element\\RatingGroup' => $baseDir . '/inc/Form/Element/RatingGroup.php',
    'WPEForm\\Form\\Element\\Row' => $baseDir . '/inc/Form/Element/Row.php',
    'WPEForm\\Form\\Element\\SingleCheckbox' => $baseDir . '/inc/Form/Element/SingleCheckbox.php',
    'WPEForm\\Form\\Element\\Slider' => $baseDir . '/inc/Form/Element/Slider.php',
    'WPEForm\\Form\\Element\\SliderGroup' => $baseDir . '/inc/Form/Element/SliderGroup.php',
    'WPEForm\\Form\\Element\\Sortable' => $baseDir . '/inc/Form/Element/Sortable.php',
    'WPEForm\\Form\\Element\\StackedGroup' => $baseDir . '/inc/Form/Element/StackedGroup.php',
    'WPEForm\\Form\\Element\\Text' => $baseDir . '/inc/Form/Element/Text.php',
    'WPEForm\\Form\\Element\\Textarea' => $baseDir . '/inc/Form/Element/Textarea.php',
    'WPEForm\\Form\\Element\\Toggle' => $baseDir . '/inc/Form/Element/Toggle.php',
    'WPEForm\\GraphQL\\Endpoint' => $baseDir . '/inc/GraphQL/Endpoint.php',
    'WPEForm\\GraphQL\\Enum\\Alignment' => $baseDir . '/inc/GraphQL/Enum/Alignment.php',
    'WPEForm\\GraphQL\\Enum\\AppearanceLayout' => $baseDir . '/inc/GraphQL/Enum/AppearanceLayout.php',
    'WPEForm\\GraphQL\\Enum\\ButtonIconPosition' => $baseDir . '/inc/GraphQL/Enum/ButtonIconPosition.php',
    'WPEForm\\GraphQL\\Enum\\ButtonOpenType' => $baseDir . '/inc/GraphQL/Enum/ButtonOpenType.php',
    'WPEForm\\GraphQL\\Enum\\CollectionPaginationType' => $baseDir . '/inc/GraphQL/Enum/CollectionPaginationType.php',
    'WPEForm\\GraphQL\\Enum\\ConsequenceAction' => $baseDir . '/inc/GraphQL/Enum/ConsequenceAction.php',
    'WPEForm\\GraphQL\\Enum\\DarkThemeMode' => $baseDir . '/inc/GraphQL/Enum/DarkThemeMode.php',
    'WPEForm\\GraphQL\\Enum\\EventComparison' => $baseDir . '/inc/GraphQL/Enum/EventComparison.php',
    'WPEForm\\GraphQL\\Enum\\EventHas' => $baseDir . '/inc/GraphQL/Enum/EventHas.php',
    'WPEForm\\GraphQL\\Enum\\EventOperation' => $baseDir . '/inc/GraphQL/Enum/EventOperation.php',
    'WPEForm\\GraphQL\\Enum\\EventRelation' => $baseDir . '/inc/GraphQL/Enum/EventRelation.php',
    'WPEForm\\GraphQL\\Enum\\FormElementCategory' => $baseDir . '/inc/GraphQL/Enum/FormElementCategory.php',
    'WPEForm\\GraphQL\\Enum\\FormPaginationRestriction' => $baseDir . '/inc/GraphQL/Enum/FormPaginationRestriction.php',
    'WPEForm\\GraphQL\\Enum\\FormPaymentType' => $baseDir . '/inc/GraphQL/Enum/FormPaymentType.php',
    'WPEForm\\GraphQL\\Enum\\FormPaymentsCouponType' => $baseDir . '/inc/GraphQL/Enum/FormPaymentsCouponType.php',
    'WPEForm\\GraphQL\\Enum\\FormSettingsBackgroundAttachment' => $baseDir . '/inc/GraphQL/Enum/FormSettingsBackgroundAttachment.php',
    'WPEForm\\GraphQL\\Enum\\FormSettingsBackgroundOriginAndClip' => $baseDir . '/inc/GraphQL/Enum/FormSettingsBackgroundOriginAndClip.php',
    'WPEForm\\GraphQL\\Enum\\FormSettingsBackgroundRepeat' => $baseDir . '/inc/GraphQL/Enum/FormSettingsBackgroundRepeat.php',
    'WPEForm\\GraphQL\\Enum\\FormSettingsLimitOnLogin' => $baseDir . '/inc/GraphQL/Enum/FormSettingsLimitOnLogin.php',
    'WPEForm\\GraphQL\\Enum\\FormType' => $baseDir . '/inc/GraphQL/Enum/FormType.php',
    'WPEForm\\GraphQL\\Enum\\GenericSize' => $baseDir . '/inc/GraphQL/Enum/GenericSize.php',
    'WPEForm\\GraphQL\\Enum\\HeadingSize' => $baseDir . '/inc/GraphQL/Enum/HeadingSize.php',
    'WPEForm\\GraphQL\\Enum\\HeadingTag' => $baseDir . '/inc/GraphQL/Enum/HeadingTag.php',
    'WPEForm\\GraphQL\\Enum\\MaskType' => $baseDir . '/inc/GraphQL/Enum/MaskType.php',
    'WPEForm\\GraphQL\\Enum\\NumberComparison' => $baseDir . '/inc/GraphQL/Enum/NumberComparison.php',
    'WPEForm\\GraphQL\\Enum\\OptionColumn' => $baseDir . '/inc/GraphQL/Enum/OptionColumn.php',
    'WPEForm\\GraphQL\\Enum\\PrefilType' => $baseDir . '/inc/GraphQL/Enum/PrefilType.php',
    'WPEForm\\GraphQL\\Enum\\RedirectType' => $baseDir . '/inc/GraphQL/Enum/RedirectType.php',
    'WPEForm\\GraphQL\\Enum\\ResourceViewMode' => $baseDir . '/inc/GraphQL/Enum/ResourceViewMode.php',
    'WPEForm\\GraphQL\\Enum\\ScoreFromToType' => $baseDir . '/inc/GraphQL/Enum/ScoreFromToType.php',
    'WPEForm\\GraphQL\\Enum\\ScoreOperation' => $baseDir . '/inc/GraphQL/Enum/ScoreOperation.php',
    'WPEForm\\GraphQL\\Enum\\SelectType' => $baseDir . '/inc/GraphQL/Enum/SelectType.php',
    'WPEForm\\GraphQL\\Enum\\SettingsAppearanceContainerLayout' => $baseDir . '/inc/GraphQL/Enum/SettingsAppearanceContainerLayout.php',
    'WPEForm\\GraphQL\\Enum\\SettingsAppearanceControlAlignment' => $baseDir . '/inc/GraphQL/Enum/SettingsAppearanceControlAlignment.php',
    'WPEForm\\GraphQL\\Enum\\SettingsAppearanceControlLayout' => $baseDir . '/inc/GraphQL/Enum/SettingsAppearanceControlLayout.php',
    'WPEForm\\GraphQL\\Enum\\SettingsAppearanceControlType' => $baseDir . '/inc/GraphQL/Enum/SettingsAppearanceControlType.php',
    'WPEForm\\GraphQL\\Enum\\SettingsAppearanceProgressBarPosition' => $baseDir . '/inc/GraphQL/Enum/SettingsAppearanceProgressBarPosition.php',
    'WPEForm\\GraphQL\\Enum\\SubmissionStatInterval' => $baseDir . '/inc/GraphQL/Enum/SubmissionStatInterval.php',
    'WPEForm\\GraphQL\\Enum\\SubmitTimer' => $baseDir . '/inc/GraphQL/Enum/SubmitTimer.php',
    'WPEForm\\GraphQL\\Enum\\Trash' => $baseDir . '/inc/GraphQL/Enum/Trash.php',
    'WPEForm\\GraphQL\\Enum\\ValidationFilterType' => $baseDir . '/inc/GraphQL/Enum/ValidationFilterType.php',
    'WPEForm\\GraphQL\\Enum\\WidthPresets' => $baseDir . '/inc/GraphQL/Enum/WidthPresets.php',
    'WPEForm\\GraphQL\\Field\\Base' => $baseDir . '/inc/GraphQL/Field/Base.php',
    'WPEForm\\GraphQL\\Field\\Category' => $baseDir . '/inc/GraphQL/Field/Category.php',
    'WPEForm\\GraphQL\\Field\\FormElementMatrixRowColumn' => $baseDir . '/inc/GraphQL/Field/FormElementMatrixRowColumn.php',
    'WPEForm\\GraphQL\\Field\\Form\\Button' => $baseDir . '/inc/GraphQL/Field/Form/Button.php',
    'WPEForm\\GraphQL\\Field\\Form\\Consequence' => $baseDir . '/inc/GraphQL/Field/Form/Consequence.php',
    'WPEForm\\GraphQL\\Field\\Form\\ElementConfig' => $baseDir . '/inc/GraphQL/Field/Form/ElementConfig.php',
    'WPEForm\\GraphQL\\Field\\Form\\ElementConfigAttributes' => $baseDir . '/inc/GraphQL/Field/Form/ElementConfigAttributes.php',
    'WPEForm\\GraphQL\\Field\\Form\\ElementConfigFilters' => $baseDir . '/inc/GraphQL/Field/Form/ElementConfigFilters.php',
    'WPEForm\\GraphQL\\Field\\Form\\ElementConfigMasks' => $baseDir . '/inc/GraphQL/Field/Form/ElementConfigMasks.php',
    'WPEForm\\GraphQL\\Field\\Form\\ElementScore' => $baseDir . '/inc/GraphQL/Field/Form/ElementScore.php',
    'WPEForm\\GraphQL\\Field\\Form\\Event' => $baseDir . '/inc/GraphQL/Field/Form/Event.php',
    'WPEForm\\GraphQL\\Field\\Form\\IntegrationCustomData' => $baseDir . '/inc/GraphQL/Field/Form/IntegrationCustomData.php',
    'WPEForm\\GraphQL\\Field\\Form\\McqOption' => $baseDir . '/inc/GraphQL/Field/Form/McqOption.php',
    'WPEForm\\GraphQL\\Field\\Form\\ScoreConditionalRedirectionItem' => $baseDir . '/inc/GraphQL/Field/Form/ScoreConditionalRedirectionItem.php',
    'WPEForm\\GraphQL\\Field\\Form\\ScoreDesignation' => $baseDir . '/inc/GraphQL/Field/Form/ScoreDesignation.php',
    'WPEForm\\GraphQL\\Field\\Form\\ScoreItem' => $baseDir . '/inc/GraphQL/Field/Form/ScoreItem.php',
    'WPEForm\\GraphQL\\Field\\Form\\ScorePercentageRedirectionItem' => $baseDir . '/inc/GraphQL/Field/Form/ScorePercentageRedirectionItem.php',
    'WPEForm\\GraphQL\\Field\\Form\\ScoreTotalRedirectionItem' => $baseDir . '/inc/GraphQL/Field/Form/ScoreTotalRedirectionItem.php',
    'WPEForm\\GraphQL\\Field\\Form\\SliderMark' => $baseDir . '/inc/GraphQL/Field/Form/SliderMark.php',
    'WPEForm\\GraphQL\\Field\\Form\\StructureConfig' => $baseDir . '/inc/GraphQL/Field/Form/StructureConfig.php',
    'WPEForm\\GraphQL\\Field\\SiteSettings' => $baseDir . '/inc/GraphQL/Field/SiteSettings.php',
    'WPEForm\\GraphQL\\Field\\Submission\\Element\\Value' => $baseDir . '/inc/GraphQL/Field/Submission/Element/Value.php',
    'WPEForm\\GraphQL\\Input\\Category' => $baseDir . '/inc/GraphQL/Input/Category.php',
    'WPEForm\\GraphQL\\Input\\Category\\Filter' => $baseDir . '/inc/GraphQL/Input/Category/Filter.php',
    'WPEForm\\GraphQL\\Input\\Form' => $baseDir . '/inc/GraphQL/Input/Form.php',
    'WPEForm\\GraphQL\\Input\\Form\\Conditional' => $baseDir . '/inc/GraphQL/Input/Form/Conditional.php',
    'WPEForm\\GraphQL\\Input\\Form\\Conditional\\Consequence' => $baseDir . '/inc/GraphQL/Input/Form/Conditional/Consequence.php',
    'WPEForm\\GraphQL\\Input\\Form\\Conditional\\Event' => $baseDir . '/inc/GraphQL/Input/Form/Conditional/Event.php',
    'WPEForm\\GraphQL\\Input\\Form\\Element' => $baseDir . '/inc/GraphQL/Input/Form/Element.php',
    'WPEForm\\GraphQL\\Input\\Form\\ElementAppearanceWidth' => $baseDir . '/inc/GraphQL/Input/Form/ElementAppearanceWidth.php',
    'WPEForm\\GraphQL\\Input\\Form\\Element\\Appearance' => $baseDir . '/inc/GraphQL/Input/Form/Element/Appearance.php',
    'WPEForm\\GraphQL\\Input\\Form\\Element\\Config' => $baseDir . '/inc/GraphQL/Input/Form/Element/Config.php',
    'WPEForm\\GraphQL\\Input\\Form\\Element\\Config\\Attributes' => $baseDir . '/inc/GraphQL/Input/Form/Element/Config/Attributes.php',
    'WPEForm\\GraphQL\\Input\\Form\\Element\\Config\\Button' => $baseDir . '/inc/GraphQL/Input/Form/Element/Config/Button.php',
    'WPEForm\\GraphQL\\Input\\Form\\Element\\Config\\Filters' => $baseDir . '/inc/GraphQL/Input/Form/Element/Config/Filters.php',
    'WPEForm\\GraphQL\\Input\\Form\\Element\\Config\\MaskRegExp' => $baseDir . '/inc/GraphQL/Input/Form/Element/Config/MaskRegExp.php',
    'WPEForm\\GraphQL\\Input\\Form\\Element\\Config\\Masks' => $baseDir . '/inc/GraphQL/Input/Form/Element/Config/Masks.php',
    'WPEForm\\GraphQL\\Input\\Form\\Element\\Config\\McqOption' => $baseDir . '/inc/GraphQL/Input/Form/Element/Config/McqOption.php',
    'WPEForm\\GraphQL\\Input\\Form\\Element\\Config\\Score' => $baseDir . '/inc/GraphQL/Input/Form/Element/Config/Score.php',
    'WPEForm\\GraphQL\\Input\\Form\\Element\\Config\\SliderMark' => $baseDir . '/inc/GraphQL/Input/Form/Element/Config/SliderMark.php',
    'WPEForm\\GraphQL\\Input\\Form\\Element\\MatrixRowColumn' => $baseDir . '/inc/GraphQL/Input/Form/Element/MatrixRowColumn.php',
    'WPEForm\\GraphQL\\Input\\Form\\Filter' => $baseDir . '/inc/GraphQL/Input/Form/Filter.php',
    'WPEForm\\GraphQL\\Input\\Form\\IntegrationCustomData' => $baseDir . '/inc/GraphQL/Input/Form/IntegrationCustomData.php',
    'WPEForm\\GraphQL\\Input\\Form\\Integrations' => $baseDir . '/inc/GraphQL/Input/Form/Integrations.php',
    'WPEForm\\GraphQL\\Input\\Form\\Payments' => $baseDir . '/inc/GraphQL/Input/Form/Payments.php',
    'WPEForm\\GraphQL\\Input\\Form\\Permissions' => $baseDir . '/inc/GraphQL/Input/Form/Permissions.php',
    'WPEForm\\GraphQL\\Input\\Form\\Pool' => $baseDir . '/inc/GraphQL/Input/Form/Pool.php',
    'WPEForm\\GraphQL\\Input\\Form\\ScoreConditionalRedirectionItem' => $baseDir . '/inc/GraphQL/Input/Form/ScoreConditionalRedirectionItem.php',
    'WPEForm\\GraphQL\\Input\\Form\\ScoreDesignation' => $baseDir . '/inc/GraphQL/Input/Form/ScoreDesignation.php',
    'WPEForm\\GraphQL\\Input\\Form\\ScoreItem' => $baseDir . '/inc/GraphQL/Input/Form/ScoreItem.php',
    'WPEForm\\GraphQL\\Input\\Form\\ScorePercentageRedirectionItem' => $baseDir . '/inc/GraphQL/Input/Form/ScorePercentageRedirectionItem.php',
    'WPEForm\\GraphQL\\Input\\Form\\ScoreTotalRedirectionItem' => $baseDir . '/inc/GraphQL/Input/Form/ScoreTotalRedirectionItem.php',
    'WPEForm\\GraphQL\\Input\\Form\\Settings' => $baseDir . '/inc/GraphQL/Input/Form/Settings.php',
    'WPEForm\\GraphQL\\Input\\Form\\Structure' => $baseDir . '/inc/GraphQL/Input/Form/Structure.php',
    'WPEForm\\GraphQL\\Input\\Form\\StructureConfig' => $baseDir . '/inc/GraphQL/Input/Form/StructureConfig.php',
    'WPEForm\\GraphQL\\Input\\Form\\Styles' => $baseDir . '/inc/GraphQL/Input/Form/Styles.php',
    'WPEForm\\GraphQL\\Input\\Pagination' => $baseDir . '/inc/GraphQL/Input/Pagination.php',
    'WPEForm\\GraphQL\\Input\\SiteSettings' => $baseDir . '/inc/GraphQL/Input/SiteSettings.php',
    'WPEForm\\GraphQL\\Input\\Submission' => $baseDir . '/inc/GraphQL/Input/Submission.php',
    'WPEForm\\GraphQL\\Input\\Submission\\Element' => $baseDir . '/inc/GraphQL/Input/Submission/Element.php',
    'WPEForm\\GraphQL\\Input\\Submission\\Element\\Value' => $baseDir . '/inc/GraphQL/Input/Submission/Element/Value.php',
    'WPEForm\\GraphQL\\Input\\Submission\\Filter' => $baseDir . '/inc/GraphQL/Input/Submission/Filter.php',
    'WPEForm\\GraphQL\\Registry' => $baseDir . '/inc/GraphQL/Registry.php',
    'WPEForm\\GraphQL\\Resolver\\Category' => $baseDir . '/inc/GraphQL/Resolver/Category.php',
    'WPEForm\\GraphQL\\Resolver\\Dashboard' => $baseDir . '/inc/GraphQL/Resolver/Dashboard.php',
    'WPEForm\\GraphQL\\Resolver\\DataSet' => $baseDir . '/inc/GraphQL/Resolver/DataSet.php',
    'WPEForm\\GraphQL\\Resolver\\Form' => $baseDir . '/inc/GraphQL/Resolver/Form.php',
    'WPEForm\\GraphQL\\Resolver\\FormTemplate' => $baseDir . '/inc/GraphQL/Resolver/FormTemplate.php',
    'WPEForm\\GraphQL\\Resolver\\HeadlessGlobals' => $baseDir . '/inc/GraphQL/Resolver/HeadlessGlobals.php',
    'WPEForm\\GraphQL\\Resolver\\IResolver' => $baseDir . '/inc/GraphQL/Resolver/IResolver.php',
    'WPEForm\\GraphQL\\Resolver\\SiteSettings' => $baseDir . '/inc/GraphQL/Resolver/SiteSettings.php',
    'WPEForm\\GraphQL\\Resolver\\Submission' => $baseDir . '/inc/GraphQL/Resolver/Submission.php',
    'WPEForm\\GraphQL\\Resolver\\User' => $baseDir . '/inc/GraphQL/Resolver/User.php',
    'WPEForm\\GraphQL\\Resolver\\Wp' => $baseDir . '/inc/GraphQL/Resolver/Wp.php',
    'WPEForm\\GraphQL\\Schema' => $baseDir . '/inc/GraphQL/Schema.php',
    'WPEForm\\GraphQL\\Server\\Helper' => $baseDir . '/inc/GraphQL/Server/Helper.php',
    'WPEForm\\GraphQL\\Server\\StandardServer' => $baseDir . '/inc/GraphQL/Server/StandardServer.php',
    'WPEForm\\GraphQL\\Type\\Category' => $baseDir . '/inc/GraphQL/Type/Category.php',
    'WPEForm\\GraphQL\\Type\\Category\\Collection' => $baseDir . '/inc/GraphQL/Type/Category/Collection.php',
    'WPEForm\\GraphQL\\Type\\Category\\Edge' => $baseDir . '/inc/GraphQL/Type/Category/Edge.php',
    'WPEForm\\GraphQL\\Type\\CumulativeFormsStat' => $baseDir . '/inc/GraphQL/Type/CumulativeFormsStat.php',
    'WPEForm\\GraphQL\\Type\\DataSet' => $baseDir . '/inc/GraphQL/Type/DataSet.php',
    'WPEForm\\GraphQL\\Type\\Form' => $baseDir . '/inc/GraphQL/Type/Form.php',
    'WPEForm\\GraphQL\\Type\\FormMeta' => $baseDir . '/inc/GraphQL/Type/FormMeta.php',
    'WPEForm\\GraphQL\\Type\\FormMeta\\Category' => $baseDir . '/inc/GraphQL/Type/FormMeta/Category.php',
    'WPEForm\\GraphQL\\Type\\FormMeta\\Definition' => $baseDir . '/inc/GraphQL/Type/FormMeta/Definition.php',
    'WPEForm\\GraphQL\\Type\\FormMeta\\Element' => $baseDir . '/inc/GraphQL/Type/FormMeta/Element.php',
    'WPEForm\\GraphQL\\Type\\FormMeta\\Owner' => $baseDir . '/inc/GraphQL/Type/FormMeta/Owner.php',
    'WPEForm\\GraphQL\\Type\\FormMeta\\PaymentGateway' => $baseDir . '/inc/GraphQL/Type/FormMeta/PaymentGateway.php',
    'WPEForm\\GraphQL\\Type\\FormTemplate' => $baseDir . '/inc/GraphQL/Type/FormTemplate.php',
    'WPEForm\\GraphQL\\Type\\FormTemplateNode' => $baseDir . '/inc/GraphQL/Type/FormTemplateNode.php',
    'WPEForm\\GraphQL\\Type\\Form\\Collection' => $baseDir . '/inc/GraphQL/Type/Form/Collection.php',
    'WPEForm\\GraphQL\\Type\\Form\\Conditional' => $baseDir . '/inc/GraphQL/Type/Form/Conditional.php',
    'WPEForm\\GraphQL\\Type\\Form\\Conditional\\Consequence' => $baseDir . '/inc/GraphQL/Type/Form/Conditional/Consequence.php',
    'WPEForm\\GraphQL\\Type\\Form\\Conditional\\Event' => $baseDir . '/inc/GraphQL/Type/Form/Conditional/Event.php',
    'WPEForm\\GraphQL\\Type\\Form\\Edge' => $baseDir . '/inc/GraphQL/Type/Form/Edge.php',
    'WPEForm\\GraphQL\\Type\\Form\\Element' => $baseDir . '/inc/GraphQL/Type/Form/Element.php',
    'WPEForm\\GraphQL\\Type\\Form\\ElementAppearanceWidth' => $baseDir . '/inc/GraphQL/Type/Form/ElementAppearanceWidth.php',
    'WPEForm\\GraphQL\\Type\\Form\\Element\\Appearance' => $baseDir . '/inc/GraphQL/Type/Form/Element/Appearance.php',
    'WPEForm\\GraphQL\\Type\\Form\\Element\\Config' => $baseDir . '/inc/GraphQL/Type/Form/Element/Config.php',
    'WPEForm\\GraphQL\\Type\\Form\\Element\\Config\\Attributes' => $baseDir . '/inc/GraphQL/Type/Form/Element/Config/Attributes.php',
    'WPEForm\\GraphQL\\Type\\Form\\Element\\Config\\Button' => $baseDir . '/inc/GraphQL/Type/Form/Element/Config/Button.php',
    'WPEForm\\GraphQL\\Type\\Form\\Element\\Config\\Filters' => $baseDir . '/inc/GraphQL/Type/Form/Element/Config/Filters.php',
    'WPEForm\\GraphQL\\Type\\Form\\Element\\Config\\MaskRegExp' => $baseDir . '/inc/GraphQL/Type/Form/Element/Config/MaskRegExp.php',
    'WPEForm\\GraphQL\\Type\\Form\\Element\\Config\\Masks' => $baseDir . '/inc/GraphQL/Type/Form/Element/Config/Masks.php',
    'WPEForm\\GraphQL\\Type\\Form\\Element\\Config\\McqOption' => $baseDir . '/inc/GraphQL/Type/Form/Element/Config/McqOption.php',
    'WPEForm\\GraphQL\\Type\\Form\\Element\\Config\\Score' => $baseDir . '/inc/GraphQL/Type/Form/Element/Config/Score.php',
    'WPEForm\\GraphQL\\Type\\Form\\Element\\Config\\SliderMark' => $baseDir . '/inc/GraphQL/Type/Form/Element/Config/SliderMark.php',
    'WPEForm\\GraphQL\\Type\\Form\\Element\\MatrixRowColumn' => $baseDir . '/inc/GraphQL/Type/Form/Element/MatrixRowColumn.php',
    'WPEForm\\GraphQL\\Type\\Form\\IntegrationCustomData' => $baseDir . '/inc/GraphQL/Type/Form/IntegrationCustomData.php',
    'WPEForm\\GraphQL\\Type\\Form\\Integrations' => $baseDir . '/inc/GraphQL/Type/Form/Integrations.php',
    'WPEForm\\GraphQL\\Type\\Form\\LimitationMessage' => $baseDir . '/inc/GraphQL/Type/Form/LimitationMessage.php',
    'WPEForm\\GraphQL\\Type\\Form\\Node' => $baseDir . '/inc/GraphQL/Type/Form/Node.php',
    'WPEForm\\GraphQL\\Type\\Form\\Payments' => $baseDir . '/inc/GraphQL/Type/Form/Payments.php',
    'WPEForm\\GraphQL\\Type\\Form\\Permissions' => $baseDir . '/inc/GraphQL/Type/Form/Permissions.php',
    'WPEForm\\GraphQL\\Type\\Form\\Pool' => $baseDir . '/inc/GraphQL/Type/Form/Pool.php',
    'WPEForm\\GraphQL\\Type\\Form\\ScoreConditionalRedirectionItem' => $baseDir . '/inc/GraphQL/Type/Form/ScoreConditionalRedirectionItem.php',
    'WPEForm\\GraphQL\\Type\\Form\\ScoreDesignation' => $baseDir . '/inc/GraphQL/Type/Form/ScoreDesignation.php',
    'WPEForm\\GraphQL\\Type\\Form\\ScoreItem' => $baseDir . '/inc/GraphQL/Type/Form/ScoreItem.php',
    'WPEForm\\GraphQL\\Type\\Form\\ScorePercentageRedirectionItem' => $baseDir . '/inc/GraphQL/Type/Form/ScorePercentageRedirectionItem.php',
    'WPEForm\\GraphQL\\Type\\Form\\ScoreTotalRedirectionItem' => $baseDir . '/inc/GraphQL/Type/Form/ScoreTotalRedirectionItem.php',
    'WPEForm\\GraphQL\\Type\\Form\\Settings' => $baseDir . '/inc/GraphQL/Type/Form/Settings.php',
    'WPEForm\\GraphQL\\Type\\Form\\Structure' => $baseDir . '/inc/GraphQL/Type/Form/Structure.php',
    'WPEForm\\GraphQL\\Type\\Form\\StructureConfig' => $baseDir . '/inc/GraphQL/Type/Form/StructureConfig.php',
    'WPEForm\\GraphQL\\Type\\Form\\Styles' => $baseDir . '/inc/GraphQL/Type/Form/Styles.php',
    'WPEForm\\GraphQL\\Type\\HeadlessGlobals' => $baseDir . '/inc/GraphQL/Type/HeadlessGlobals.php',
    'WPEForm\\GraphQL\\Type\\Me' => $baseDir . '/inc/GraphQL/Type/Me.php',
    'WPEForm\\GraphQL\\Type\\Mutation' => $baseDir . '/inc/GraphQL/Type/Mutation.php',
    'WPEForm\\GraphQL\\Type\\Page' => $baseDir . '/inc/GraphQL/Type/Page.php',
    'WPEForm\\GraphQL\\Type\\PageInfo' => $baseDir . '/inc/GraphQL/Type/PageInfo.php',
    'WPEForm\\GraphQL\\Type\\PerformingFormStat' => $baseDir . '/inc/GraphQL/Type/PerformingFormStat.php',
    'WPEForm\\GraphQL\\Type\\Query' => $baseDir . '/inc/GraphQL/Type/Query.php',
    'WPEForm\\GraphQL\\Type\\RangeBasedStatBreakdown' => $baseDir . '/inc/GraphQL/Type/RangeBasedStatBreakdown.php',
    'WPEForm\\GraphQL\\Type\\Score' => $baseDir . '/inc/GraphQL/Type/Score.php',
    'WPEForm\\GraphQL\\Type\\SiteSettings' => $baseDir . '/inc/GraphQL/Type/SiteSettings.php',
    'WPEForm\\GraphQL\\Type\\Submission' => $baseDir . '/inc/GraphQL/Type/Submission.php',
    'WPEForm\\GraphQL\\Type\\SubmissionIntervalStat' => $baseDir . '/inc/GraphQL/Type/SubmissionIntervalStat.php',
    'WPEForm\\GraphQL\\Type\\SubmissionMeta' => $baseDir . '/inc/GraphQL/Type/SubmissionMeta.php',
    'WPEForm\\GraphQL\\Type\\SubmissionMeta\\Category' => $baseDir . '/inc/GraphQL/Type/SubmissionMeta/Category.php',
    'WPEForm\\GraphQL\\Type\\SubmissionMeta\\Form' => $baseDir . '/inc/GraphQL/Type/SubmissionMeta/Form.php',
    'WPEForm\\GraphQL\\Type\\SubmissionMeta\\Owner' => $baseDir . '/inc/GraphQL/Type/SubmissionMeta/Owner.php',
    'WPEForm\\GraphQL\\Type\\SubmissionStat' => $baseDir . '/inc/GraphQL/Type/SubmissionStat.php',
    'WPEForm\\GraphQL\\Type\\Submission\\Collection' => $baseDir . '/inc/GraphQL/Type/Submission/Collection.php',
    'WPEForm\\GraphQL\\Type\\Submission\\Edge' => $baseDir . '/inc/GraphQL/Type/Submission/Edge.php',
    'WPEForm\\GraphQL\\Type\\Submission\\Element' => $baseDir . '/inc/GraphQL/Type/Submission/Element.php',
    'WPEForm\\GraphQL\\Type\\Submission\\Element\\Score' => $baseDir . '/inc/GraphQL/Type/Submission/Element/Score.php',
    'WPEForm\\GraphQL\\Type\\Submission\\Element\\Value' => $baseDir . '/inc/GraphQL/Type/Submission/Element/Value.php',
    'WPEForm\\GraphQL\\Type\\Submission\\Node' => $baseDir . '/inc/GraphQL/Type/Submission/Node.php',
    'WPEForm\\GraphQL\\Type\\UpdateLog' => $baseDir . '/inc/GraphQL/Type/UpdateLog.php',
    'WPEForm\\GraphQL\\Type\\User' => $baseDir . '/inc/GraphQL/Type/User.php',
    'WPEForm\\GraphQL\\Util\\FieldVar' => $baseDir . '/inc/GraphQL/Util/FieldVar.php',
    'WPEForm\\GraphQL\\Util\\TypeOrInputFromFields' => $baseDir . '/inc/GraphQL/Util/TypeOrInputFromFields.php',
    'WPEForm\\Handler\\Headless' => $baseDir . '/inc/Handler/Headless.php',
    'WPEForm\\Handler\\Payment' => $baseDir . '/inc/Handler/Payment.php',
    'WPEForm\\Handler\\Submission' => $baseDir . '/inc/Handler/Submission.php',
    'WPEForm\\Model\\Base' => $baseDir . '/inc/Model/Base.php',
    'WPEForm\\Model\\Category' => $baseDir . '/inc/Model/Category.php',
    'WPEForm\\Model\\Dashboard' => $baseDir . '/inc/Model/Dashboard.php',
    'WPEForm\\Model\\Form' => $baseDir . '/inc/Model/Form.php',
    'WPEForm\\Model\\IModel' => $baseDir . '/inc/Model/IModel.php',
    'WPEForm\\Model\\Payment' => $baseDir . '/inc/Model/Payment.php',
    'WPEForm\\Model\\SiteSettings' => $baseDir . '/inc/Model/SiteSettings.php',
    'WPEForm\\Model\\Submission' => $baseDir . '/inc/Model/Submission.php',
    'WPEForm\\States\\Submission\\Base' => $baseDir . '/inc/States/Submission/Base.php',
    'WPEForm\\States\\Submission\\Clock' => $baseDir . '/inc/States/Submission/Clock.php',
    'WPEForm\\States\\Submission\\Conditionals' => $baseDir . '/inc/States/Submission/Conditionals.php',
    'WPEForm\\States\\Submission\\Elements' => $baseDir . '/inc/States/Submission/Elements.php',
    'WPEForm\\States\\Submission\\Html' => $baseDir . '/inc/States/Submission/Html.php',
    'WPEForm\\States\\Submission\\Mailer' => $baseDir . '/inc/States/Submission/Mailer.php',
    'WPEForm\\States\\Submission\\Pdf' => $baseDir . '/inc/States/Submission/Pdf.php',
    'WPEForm\\States\\Submission\\Primitives' => $baseDir . '/inc/States/Submission/Primitives.php',
    'WPEForm\\States\\Submission\\Score' => $baseDir . '/inc/States/Submission/Score.php',
    'WPEForm\\States\\Submission\\Slate' => $baseDir . '/inc/States/Submission/Slate.php',
    'WPEForm\\System\\Endpoints' => $baseDir . '/inc/System/Endpoints.php',
    'WPEForm\\System\\Init' => $baseDir . '/inc/System/Init.php',
    'WPEForm\\System\\Install' => $baseDir . '/inc/System/Install.php',
    'WPEForm\\System\\SystemEndpoint' => $baseDir . '/inc/System/SystemEndpoint.php',
    'WPEForm\\Util\\Crypt' => $baseDir . '/inc/Util/Crypt.php',
    'WPEForm\\Util\\DataSet\\DataSet' => $baseDir . '/inc/Util/DataSet/DataSet.php',
    'WPEForm\\Util\\FormTemplate' => $baseDir . '/inc/Util/FormTemplate.php',
    'WPEForm\\Util\\HTMLChart' => $baseDir . '/inc/Util/HTMLChart.php',
    'WPEForm\\Util\\Icon' => $baseDir . '/inc/Util/Icon.php',
    'WPEForm\\Util\\Mailer' => $baseDir . '/inc/Util/Mailer.php',
    'WPEForm\\Util\\Pdf' => $baseDir . '/inc/Util/Pdf.php',
    'WPEForm\\Util\\PerfMeasurer' => $baseDir . '/inc/Util/PerfMeasurer.php',
    'WPEForm\\Util\\SlateJS' => $baseDir . '/inc/Util/SlateJS.php',
    'WPEForm\\Util\\Style' => $baseDir . '/inc/Util/Style.php',
    'WPEForm\\Util\\TVarDumper' => $baseDir . '/inc/Util/TVarDumper.php',
    'WPEForm\\View\\Admin\\App' => $baseDir . '/inc/View/Admin/App.php',
    'WPEForm\\View\\Admin\\Base' => $baseDir . '/inc/View/Admin/Base.php',
    'WPEForm\\View\\Admin\\WPDashboard' => $baseDir . '/inc/View/Admin/WPDashboard.php',
    'WPEForm\\View\\Front\\Base' => $baseDir . '/inc/View/Front/Base.php',
    'WPEForm\\View\\Front\\Form' => $baseDir . '/inc/View/Front/Form.php',
    'WPEForm\\View\\Front\\ShortcodeGenerator' => $baseDir . '/inc/View/Front/ShortcodeGenerator.php',
    'WPEForm\\View\\Front\\Summary' => $baseDir . '/inc/View/Front/Summary.php',
    'WPEForm\\View\\Front\\UserPortal' => $baseDir . '/inc/View/Front/UserPortal.php',
);