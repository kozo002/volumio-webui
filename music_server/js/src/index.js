import React, { Component, PropTypes } from "react";
import { render } from "react-dom";
import axios from "axios";
import "promise.prototype.finally";

const APIs = {
  USBDAC:        "/music_server/usb_dac.php",
  RCA:           "/music_server/rca.php",
  AudioMiniJack: "/music_server/audio_mini_jack.php"
};

class InputButtons extends Component {
  constructor(props) {
    super(props);
    this.state = {
      isProcessing: false
    };
  }

  render() {
    const { isProcessing } = this.state;

    return (
      <ul className="select-input">
        <li>
          <a href="#"
            disabled={isProcessing}
            className="btn btn-default btn-large"
            onClick={this.onClickUSBDAC.bind(this)}>
            USB DAC
            <span className="label label-success hide">SELECTED</span>
          </a>
          <br/>
          <br/>
        </li>
        <li>
          <a href="#"
            disabled={isProcessing}
            className="btn btn-default btn-large"
            onClick={this.onClickRCA.bind(this)}>
            RCA
            <span className="label label-success hide">SELECTED</span>
          </a>
          <br/>
          <br/>
        </li>
        <li>
          <a href="#"
            disabled={isProcessing}
            className="btn btn-default btn-large"
            onClick={this.onClickAudioMiniJack.bind(this)}>
            オーディオミニジャック
            <span className="label label-success hide">SELECTED</span>
          </a>
        </li>
      </ul>
    );
  }

  onClickUSBDAC(e) {
    e.preventDefault();
    this.postRequest(APIs.USBDAC)
      .then((res) => {
        console.log(res)
      });
  }

  onClickRCA(e) {
    e.preventDefault();
    this.postRequest(APIs.RCA)
      .then((res) => {
        console.log(res)
      });
  }

  onClickAudioMiniJack(e) {
    e.preventDefault();
    this.postRequest(APIs.AudioMiniJack)
      .then((res) => {
        console.log(res)
      });
  }

  postRequest(url) {
    if (this.state.isProcessing) { return; }
    this.setState({ isProcessing: true });

    return axios.post(url)
      .catch((res) => {
        console.error(res);
        window.alert("エラーしました");
      })
      .finally(() => {
        this.setState({ isProcessing: false });
      });
  }
}

document.addEventListener("DOMContentLoaded", (_) => {
  const mountNode = document.querySelector("[data-component='InputButtons']");
  if (mountNode != null) {
    render(
      <InputButtons />,
      mountNode
    );
  }
});
