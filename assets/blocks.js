/* eslint-disable no-underscore-dangle */
/* eslint-disable react-hooks/rules-of-hooks */
/* eslint-disable import/extensions */
import React from 'react';
import { registerBlockType } from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';
import { useBlockProps } from '@wordpress/block-editor';

import { ReactComponent as FormPreviewSvg } from 'Icons/FormPreview.svg';
import { ReactComponent as UserPortalSvg } from 'Icons/UserPortal.svg';
import { ReactComponent as SummaryPageSvg } from 'Icons/SummaryPage.svg';
import Icon from 'Components/Icon';

import dictionary from '../../../../inc/Editor/dictionary.json';

import Summary from './Summary';
import UserPortal from './UserPortal';
import { FormEdit } from './Form';

// register form block
registerBlockType("wp-eform/form", {
  // @ts-ignore
  apiVersion: 2,
  title: __("WPEForm - Insert Form", "wp-eform"),
  icon: /*#__PURE__*/ React.createElement(
    Icon,
    null,
    /*#__PURE__*/ React.createElement(FormPreviewSvg, null)
  ),
  category: "widgets",
  attributes: dictionary.form.attributes,
  edit: (props) => {
    const blockProps = useBlockProps();
    return /*#__PURE__*/ React.createElement(FormEdit, {
      blockConfig: props,
      blockProps: blockProps
    });
  },
  save: () => null
}); // register user portal block

registerBlockType("wp-eform/user-portal", {
  apiVersion: 2,
  title: __("WPEForm - User Portal Page", "wp-eform"),
  icon: /*#__PURE__*/ React.createElement(
    Icon,
    null,
    /*#__PURE__*/ React.createElement(UserPortalSvg, null)
  ),
  category: "widgets",
  attributes: dictionary.userPortal.attributes,
  edit: (props) => {
    const blockProps = useBlockProps();
    return /*#__PURE__*/ React.createElement(UserPortal, {
      blockConfig: props,
      blockProps: blockProps
    });
  },
  save: () => null
}); // register summary block

registerBlockType("wp-eform/summary", {
  apiVersion: 2,
  title: __("WPEForm - Summary Page", "wp-eform"),
  icon: /*#__PURE__*/ React.createElement(
    Icon,
    null,
    /*#__PURE__*/ React.createElement(SummaryPageSvg, null)
  ),
  category: "widgets",
  attributes: dictionary.summary.attributes,
  edit: (props) => {
    const blockProps = useBlockProps();
    return /*#__PURE__*/ React.createElement(Summary, {
      blockConfig: props,
      blockProps: blockProps
    });
  },
  save: () => null
});

// compiled output can be found under dist/editor/blocks-<hash>.js
// source map can be found under dist/editor/blocks-<hash>.js.map
// this file is kept so that WordPress can pick up proper block name
