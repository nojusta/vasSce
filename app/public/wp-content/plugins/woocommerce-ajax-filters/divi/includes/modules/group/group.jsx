import React, { Component } from 'react';

class BAPFGroupFilters extends Component {

  static slug = 'et_pb_br_filters_group';
  static parameters = ['group_id',
            'display_inline',
            'display_inline_count',
            'min_filter_width_inline',
            'hidden_clickable',
            'hidden_clickable_hover',
            'group_is_hide',
            'group_is_hide_theme',
            'group_is_hide_icon_theme',
            'title_level'];
  constructor(props) {
    super(props);
    this.htmlstate = <div></div>;
    this.state = {
      error: null,
      isLoaded: false
    };
  }
  render() {
    const { error, isLoaded } = this.state;
    if (error) {
      return (<div>{error.message}</div>);
    } else if (!isLoaded) {
      return (<div style={{height:"100px"}}><div class="et-fb-loader-wrapper"><div class="et-fb-loader"></div></div></div>);
    } else {
      return this.htmlstate;
    }
  }

  componentDidUpdate(oldProps) {
      var update = false;
      BAPFGroupFilters.parameters.forEach(key => {
          if( oldProps[key] != this.props[key] ) {
              update = true;
          }
      });
      var contentData = [];
      var oldContentData = [];
      var content = this.props.content;
      var oldContent = oldProps.content;
      if( typeof(content) != 'undefined' && typeof(content.forEach) != 'undefined' ) {
          content.forEach(key => {
              contentData.push(key.props.attrs['filter_id']);
          });
      }
      if( typeof(oldContent) != 'undefined' && typeof(oldContent.forEach) != 'undefined' ) {
          oldContent.forEach(key => {
              oldContentData.push(key.props.attrs['filter_id']);
          });
      }
      if( contentData.length != oldContentData.length ) {
          update = true;
      } else {
          for( var i = 0; i < contentData.length; i++ ) {
              if( contentData[i] !=  oldContentData[i] ) {
                  update = true;
              }
          }
      }
      
      if( update ) {
        this.setState({
          error: null,
          isLoaded: false
        });
        this.componentDidMount();
      }
  }
  componentDidMount() {
    var body = new FormData();
    body.append('action', 'brapf_get_group_filter');
    var newProps = this.props;
    Object.keys(newProps).forEach(key => {
      body.append(key, newProps[key]);
    });
      var contentData = [];
      var content = newProps.content;
      if( typeof(content) != 'undefined' && typeof(content.forEach) != 'undefined' ) {
          content.forEach(key => {
              if( ! key.props.attrs['filter_id'] ) {
                  contentData.push('');
              } else {
                contentData.push(key.props.attrs['filter_id']);
              }
          });
      }
    body.append('filters', contentData);
    fetch(
      window.et_fb_options.ajaxurl, 
      {
        body: body,
        method: 'POST',        
      }
    )
      .then(res => res.text())
      .then(
        (result) => {
          if( typeof(result) === 'undefined' || ! result ) {
              this.htmlstate = (<div style={{padding:"2em 0", background: "#6c2eb9", color: "#fff", fontSize: "12px", fontWeight: "600", verticalAlign: "middle", textAlign: "center", borderRadius: "1em"}}><h3 style={{color: "#000", textShadow: "1px 0px white, -1px 0px white, 0px 1px white, 0px -1px white", fontWeight: "900"}}>BeRocket Filter Group</h3>Filter Group not displayed in Builder</div>);
              this.setState({
                isLoaded: true
              });
          } else {
              const brevent = new Event('br_update_et_pb_brands_by_name');
              window.dispatchEvent(brevent);
              this.htmlstate = (<div dangerouslySetInnerHTML={{__html: result}} />);
              this.setState({
                isLoaded: true
              });
              document.dispatchEvent(new CustomEvent('bapf_update_et_pb_br_filter_single', { 'bubbles': true }));
          }
        },
        (error) => {
          this.htmlstate = (<div style={{padding:"2em 0", background: "#6c2eb9", color: "#fff", fontSize: "12px", fontWeight: "600", verticalAlign: "middle", textAlign: "center", borderRadius: "1em"}}><h3 style={{color: "#000", textShadow: "1px 0px white, -1px 0px white, 0px 1px white, 0px -1px white", fontWeight: "900"}}>BeRocket Filter Group</h3>Filter Group not displayed in Builder</div>);
          this.setState({
            isLoaded: true
          });
        }
      )
  }
}

export default BAPFGroupFilters;
