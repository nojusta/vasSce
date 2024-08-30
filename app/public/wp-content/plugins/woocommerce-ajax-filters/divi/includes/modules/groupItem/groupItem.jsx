// External Dependencies
import React, { Component } from 'react';

class BRAAPF_group_item extends Component {

  static slug = 'et_pb_br_filters_group_item';
  render() {
      return (this.props['filter_id']);
  }
}

export default BRAAPF_group_item;
