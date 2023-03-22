<?php
session_start();
include("vendor/autoload.php");
$sn = 1;
$total = 0;
if (isset($_SESSION['cart'])) {

}
$html =
    '<!DOCTYPE html>
    <html>
      <head>
        <meta charset="utf-8" />
        <title>Tax Invoice</title>
        <link rel="shortcut icon" type="image/png" href="./favicon.png" />
        <style>
          * {
            box-sizing: border-box;
          }
    
          .table-bordered td,
          .table-bordered th {
            border: 1px solid #ddd;
            padding: 10px;
            word-break: break-all;
          }
    
          body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 16px;
          }
          .h4-14 h4 {
            font-size: 12px;
            margin-top: 0;
            margin-bottom: 5px;
          }
          .img {
            margin-left: "auto";
            margin-top: "auto";
            height: 30px;
          }
          pre,
          p {
            /* width: 99%; */
            /* overflow: auto; */
            /* bpicklist: 1px solid #aaa; */
            padding: 0;
            margin: 0;
          }
          table {
            font-family: arial, sans-serif;
            width: 100%;
            border-collapse: collapse;
            padding: 1px;
          }
          .hm-p p {
            text-align: left;
            padding: 1px;
            padding: 5px 4px;
          }
          td,
          th {
            text-align: left;
            padding: 8px 6px;
          }
          .table-b td,
          .table-b th {
            border: 1px solid #ddd;
          }
          th {
            /* background-color: #ddd; */
          }
          .hm-p td,
          .hm-p th {
            padding: 3px 0px;
          }
          .cropped {
            float: right;
            margin-bottom: 20px;
            height: 100px; /* height of container */
            overflow: hidden;
          }
          .cropped img {
            width: 400px;
            margin: 8px 0px 0px 80px;
          }
          .main-pd-wrapper {
            box-shadow: 0 0 10px #ddd;
            background-color: #fff;
            border-radius: 10px;
            padding: 15px;
          }
          .table-bordered td,
          .table-bordered th {
            border: 1px solid #ddd;
            padding: 10px;
            font-size: 14px;
          }
          .invoice-items {
            font-size: 14px;
            border-top: 1px dashed #ddd;
          }
          .invoice-items td{
            padding: 14px 0;
           
          }
        </style>
      </head>
      <body>
        <section class="main-pd-wrapper" style="width: 450px; margin: auto">
          <div style="
                      text-align: center;
                      margin: auto;
                      line-height: 1.5;
                      font-size: 14px;
                      color: #4a4a4a;
                    ">
                    <svg width="220" height="73" viewBox="0 0 272 73" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M67.0969 26.1329L59.644 38.0368C57.802 40.9813 54.5681 42.7689 51.0941 42.7607L16.7196 42.6815C13.232 42.6733 9.99539 40.8585 8.16969 37.8867L0.921475 26.0865C-1.60285 21.9739 1.35811 16.696 6.1748 16.696H15.8791L26.6778 3.42216C28.4516 1.24715 31.0742 0 33.8796 0C33.8796 0 33.8796 0 33.8823 0C36.685 0 39.3103 1.24715 41.0787 3.42489L51.88 16.696H61.8764C66.7176 16.696 69.6786 22.0312 67.0969 26.1329ZM24.0879 16.696H43.6712L36.1392 7.44197C35.3805 6.50592 34.3981 6.36674 33.8796 6.36674C33.3611 6.36674 32.3814 6.50592 31.6172 7.44197L24.0879 16.696Z" fill="#FCBE00"></path>
                      <path d="M50.8494 64.9199L33.8777 57.1177L16.9034 64.9199C12.2368 67.0622 7.10899 63.0178 8.09962 57.9828L9.44775 51.1112C10.4056 46.229 14.6874 42.7086 19.6651 42.7168L48.1395 42.7605C53.1035 42.7659 57.3689 46.2836 58.3241 51.1522L59.6668 57.9828C60.6574 63.0178 55.5159 67.0622 50.8494 64.9199Z" fill="#444A4B"></path>
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M254.834 47.3627V44.2686C253.836 45.3705 252.644 46.2525 251.256 46.9093C249.869 47.566 248.179 47.8957 246.187 47.8957C244.832 47.8957 243.56 47.7116 242.37 47.3352C241.177 46.9615 240.136 46.4009 239.246 45.6563C238.355 44.9061 237.655 43.9911 237.138 42.9057C236.622 41.8203 236.363 40.5674 236.363 39.1413V39.0368C236.363 37.4706 236.649 36.1187 237.218 34.9783C237.787 33.8408 238.581 32.8983 239.595 32.1509C240.609 31.4035 241.818 30.8429 243.225 30.4692C244.629 30.0955 246.187 29.9087 247.896 29.9087C249.352 29.9087 250.624 30.0158 251.71 30.2274C252.795 30.4418 253.853 30.7275 254.886 31.082V30.6011C254.886 28.8947 254.37 27.595 253.339 26.7048C252.306 25.8172 250.775 25.3721 248.748 25.3721C247.181 25.3721 245.802 25.504 244.612 25.7705C243.42 26.0398 242.164 26.4217 240.848 26.9191L238.82 20.7283C240.386 20.0523 242.024 19.5 243.73 19.0741C245.439 18.6455 247.503 18.4312 249.921 18.4312C254.37 18.4312 257.609 19.5193 259.637 21.6873C261.665 23.858 262.679 26.8833 262.679 30.7632V47.3627H254.834ZM254.993 35.8329C254.282 35.5114 253.49 35.2559 252.616 35.058C251.745 34.8657 250.811 34.7668 249.816 34.7668C248.072 34.7668 246.7 35.1047 245.706 35.7807C244.708 36.4567 244.211 37.4349 244.211 38.7153V38.8225C244.211 39.9244 244.62 40.7789 245.439 41.3835C246.258 41.9907 247.324 42.293 248.64 42.293C250.564 42.293 252.1 41.8286 253.259 40.9053C254.414 39.9793 254.993 38.7703 254.993 37.2755V35.8329Z" fill="#444A4B"></path>
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M147.114 34.8746C147.097 35.1576 147.07 35.4956 147.034 35.8885H127.126C127.517 37.7378 128.327 39.1337 129.553 40.0762C130.781 41.0214 132.303 41.4913 134.117 41.4913C135.469 41.4913 136.678 41.2605 137.747 40.7988C138.816 40.3372 139.917 39.5871 141.055 38.5566L145.702 42.6673C144.347 44.3407 142.712 45.6487 140.789 46.5912C138.868 47.5337 136.609 48.0035 134.01 48.0035C131.875 48.0035 129.891 47.6491 128.058 46.9374C126.225 46.2257 124.642 45.2118 123.307 43.8928C121.974 42.5766 120.933 41.0214 120.186 39.2243C119.438 37.4273 119.064 35.4241 119.064 33.2177V33.1105C119.064 31.0826 119.411 29.1619 120.106 27.3484C120.798 25.5321 121.768 23.9494 123.016 22.5974C124.261 21.2455 125.747 20.1766 127.473 19.3935C129.198 18.6104 131.111 18.2202 133.21 18.2202C135.595 18.2202 137.659 18.6461 139.401 19.5007C141.146 20.3552 142.597 21.5038 143.751 22.9437C144.907 24.3835 145.762 26.0404 146.314 27.9062C146.864 29.7747 147.141 31.7229 147.141 33.7535V33.8579C147.141 34.2508 147.133 34.5888 147.114 34.8746ZM137.321 26.4141C136.288 25.293 134.919 24.7325 133.21 24.7325C131.501 24.7325 130.122 25.2848 129.072 26.3866C128.022 27.4885 127.338 28.9668 127.017 30.8161H139.241C138.991 29.0025 138.351 27.5352 137.321 26.4141Z" fill="#444A4B"></path>
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M175.833 34.8746C175.813 35.1576 175.786 35.4956 175.75 35.8885H155.842C156.233 37.7378 157.043 39.1337 158.272 40.0762C159.5 41.0214 161.019 41.4913 162.836 41.4913C164.188 41.4913 165.397 41.2605 166.465 40.7988C167.532 40.3372 168.633 39.5871 169.774 38.5566L174.418 42.6673C173.066 44.3407 171.428 45.6487 169.507 46.5912C167.587 47.5337 165.325 48.0035 162.728 48.0035C160.593 48.0035 158.61 47.6491 156.777 46.9374C154.944 46.2257 153.361 45.2118 152.026 43.8928C150.69 42.5766 149.652 41.0214 148.904 39.2243C148.157 37.4273 147.783 35.4241 147.783 33.2177V33.1105C147.783 31.0826 148.129 29.1619 148.822 27.3484C149.517 25.5321 150.487 23.9494 151.732 22.5974C152.977 21.2455 154.463 20.1766 156.189 19.3935C157.914 18.6104 159.827 18.2202 161.926 18.2202C164.311 18.2202 166.375 18.6461 168.12 19.5007C169.862 20.3552 171.313 21.5038 172.469 22.9437C173.626 24.3835 174.481 26.0404 175.03 27.9062C175.583 29.7747 175.857 31.7229 175.857 33.7535V33.8579C175.857 34.2508 175.849 34.5888 175.833 34.8746ZM166.037 26.4141C165.006 25.293 163.635 24.7325 161.926 24.7325C160.22 24.7325 158.84 25.2848 157.791 26.3866C156.741 27.4885 156.057 28.9668 155.735 30.8161H167.96C167.71 29.0025 167.07 27.5352 166.037 26.4141Z" fill="#444A4B"></path>
                      <path d="M194.701 26.7052C191.995 26.7052 189.871 27.5268 188.321 29.1617C186.774 30.7994 185.999 33.3438 185.999 36.7951V47.3631H177.888V18.7531H185.999V24.5179C186.818 22.5615 187.939 20.9953 189.362 19.8192C190.786 18.6459 192.707 18.1128 195.127 18.22V26.7052H194.701Z" fill="#444A4B"></path>
                      <path d="M198.735 47.3629V18.2061H206.85V47.3629H198.735Z" fill="#444A4B"></path>
                      <path d="M228.892 47.3631L221.421 35.674L218.591 38.6636V47.3631H210.479V8.39941H218.591V29.1617L228.093 18.7531H237.809L226.917 30.0163L238.18 47.3631H228.892Z" fill="#444A4B"></path>
                      <path d="M206.85 12.4552C206.85 14.6974 205.033 16.5136 202.791 16.5136C200.552 16.5136 198.735 14.6974 198.735 12.4552C198.735 10.2157 200.552 8.39941 202.791 8.39941C205.033 8.39941 206.85 10.2157 206.85 12.4552Z" fill="#FCBE00"></path>
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M115.3 36.0097C114.283 38.425 112.838 40.5188 110.972 42.2912C109.106 44.0635 106.878 45.4594 104.295 46.4761C101.712 47.4955 98.8733 48.0038 95.7793 48.0038H80.334V8.3999H95.7793C98.8733 8.3999 101.712 8.89999 104.295 9.90019C106.878 10.8976 109.106 12.2853 110.972 14.0576C112.838 15.8299 114.283 17.9155 115.3 20.3088C116.319 22.7049 116.827 25.2988 116.827 28.0878V28.2032C116.827 30.9923 116.319 33.5972 115.3 36.0097ZM107.718 28.2032C107.718 26.4694 107.424 24.8647 106.842 23.3919C106.257 21.9218 105.446 20.6578 104.407 19.6026C103.371 18.5475 102.118 17.7259 100.646 17.1406C99.1756 16.5581 97.5544 16.2641 95.7793 16.2641H89.0472V40.1397H95.7793C97.5544 40.1397 99.1756 39.8566 100.646 39.2906C102.118 38.7245 103.371 37.9139 104.407 36.8588C105.446 35.8036 106.257 34.5589 106.842 33.1245C107.424 31.6929 107.718 30.0882 107.718 28.3159V28.2032Z" fill="#444A4B"></path>
                      <path d="M87.8776 66.2446H90.1272L86.312 55.6198H83.8344L80.0192 66.2446H82.2536L82.9528 64.223H87.1784L87.8776 66.2446ZM86.6008 62.5206H83.5304L85.0656 58.0822L86.6008 62.5206ZM94.6584 60.9246C94.6584 64.1014 96.984 66.3358 100.039 66.3358C102.395 66.3358 104.31 65.0894 105.025 62.9006H102.578C102.076 63.9342 101.164 64.4358 100.024 64.4358C98.1696 64.4358 96.8472 63.0678 96.8472 60.9246C96.8472 58.7662 98.1696 57.4134 100.024 57.4134C101.164 57.4134 102.076 57.915 102.578 58.9334H105.025C104.31 56.7598 102.395 55.4982 100.039 55.4982C96.984 55.4982 94.6584 57.7478 94.6584 60.9246ZM106.295 62.0038C106.295 64.6334 107.998 66.3814 110.126 66.3814C111.463 66.3814 112.421 65.743 112.922 65.0134V66.2446H115.066V57.8238H112.922V59.0246C112.421 58.3254 111.494 57.687 110.141 57.687C107.998 57.687 106.295 59.3742 106.295 62.0038ZM112.922 62.0342C112.922 63.6302 111.858 64.5118 110.688 64.5118C109.548 64.5118 108.469 63.5998 108.469 62.0038C108.469 60.4078 109.548 59.5566 110.688 59.5566C111.858 59.5566 112.922 60.4382 112.922 62.0342ZM119.272 62.0494C119.272 60.423 120.032 59.9366 121.294 59.9366H121.856V57.7022C120.686 57.7022 119.804 58.2646 119.272 59.131V57.8238H117.144V66.2446H119.272V62.0494ZM123.624 63.6302C123.624 65.5606 124.703 66.2446 126.314 66.2446H127.652V64.451H126.664C125.995 64.451 125.767 64.2078 125.767 63.6454V59.5718H127.652V57.8238H125.767V55.7414H123.624V57.8238H122.62V59.5718H123.624V63.6302ZM132.804 66.2446H134.932V61.7606H138.322V60.0734H134.932V57.3526H139.355V55.635H132.804V66.2446ZM148.814 57.8238H146.671V62.4598C146.671 63.8126 145.941 64.5422 144.786 64.5422C143.661 64.5422 142.916 63.8126 142.916 62.4598V57.8238H140.788V62.7638C140.788 65.0742 142.202 66.351 144.163 66.351C145.211 66.351 146.139 65.895 146.671 65.1806V66.2446H148.814V57.8238ZM150.913 66.2446H153.041V54.9966H150.913V66.2446ZM155.144 66.2446H157.272V54.9966H155.144V66.2446ZM173.347 60.9094C173.347 57.7326 170.946 55.483 167.921 55.483C164.927 55.483 162.479 57.7326 162.479 60.9094C162.479 64.1014 164.927 66.351 167.921 66.351C170.931 66.351 173.347 64.1014 173.347 60.9094ZM164.668 60.9094C164.668 58.751 165.991 57.3982 167.921 57.3982C169.836 57.3982 171.159 58.751 171.159 60.9094C171.159 63.0678 169.836 64.451 167.921 64.451C165.991 64.451 164.668 63.0678 164.668 60.9094ZM175.159 66.2446H177.317V59.5718H178.791V57.8238H177.317V57.4742C177.317 56.5318 177.667 56.1974 178.7 56.2278V54.4342C176.329 54.3734 175.159 55.331 175.159 57.3982V57.8238H174.201V59.5718H175.159V66.2446ZM190.465 66.2446H192.593V55.635H190.465V59.9974H185.92V55.635H183.792V66.2446H185.92V61.7302H190.465V66.2446ZM194.14 62.0038C194.14 64.6334 195.843 66.3814 197.971 66.3814C199.308 66.3814 200.266 65.743 200.768 65.0134V66.2446H202.911V57.8238H200.768V59.0246C200.266 58.3254 199.339 57.687 197.986 57.687C195.843 57.687 194.14 59.3742 194.14 62.0038ZM200.768 62.0342C200.768 63.6302 199.704 64.5118 198.533 64.5118C197.393 64.5118 196.314 63.5998 196.314 62.0038C196.314 60.4078 197.393 59.5566 198.533 59.5566C199.704 59.5566 200.768 60.4382 200.768 62.0342ZM207.117 59.0398V57.8238H204.989V70.2574H207.117V65.0438C207.634 65.7278 208.576 66.3814 209.899 66.3814C212.057 66.3814 213.744 64.6334 213.744 62.0038C213.744 59.3742 212.057 57.687 209.899 57.687C208.592 57.687 207.619 58.3254 207.117 59.0398ZM211.571 62.0038C211.571 63.5998 210.492 64.5118 209.336 64.5118C208.196 64.5118 207.117 63.6302 207.117 62.0342C207.117 60.4382 208.196 59.5566 209.336 59.5566C210.492 59.5566 211.571 60.4078 211.571 62.0038ZM217.419 59.0398V57.8238H215.291V70.2574H217.419V65.0438C217.936 65.7278 218.878 66.3814 220.2 66.3814C222.359 66.3814 224.046 64.6334 224.046 62.0038C224.046 59.3742 222.359 57.687 220.2 57.687C218.893 57.687 217.92 58.3254 217.419 59.0398ZM221.872 62.0038C221.872 63.5998 220.793 64.5118 219.638 64.5118C218.498 64.5118 217.419 63.6302 217.419 62.0342C217.419 60.4382 218.498 59.5566 219.638 59.5566C220.793 59.5566 221.872 60.4078 221.872 62.0038ZM225.592 66.2446H227.72V57.8238H225.592V66.2446ZM226.672 56.8206C227.416 56.8206 227.979 56.2734 227.979 55.5742C227.979 54.875 227.416 54.3278 226.672 54.3278C225.912 54.3278 225.364 54.875 225.364 55.5742C225.364 56.2734 225.912 56.8206 226.672 56.8206ZM235.72 66.2446H237.848V61.3046C237.848 58.979 236.45 57.7022 234.489 57.7022C233.41 57.7022 232.498 58.1582 231.951 58.8726V57.8238H229.823V66.2446H231.951V61.5934C231.951 60.2406 232.696 59.511 233.851 59.511C234.976 59.511 235.72 60.2406 235.72 61.5934V66.2446ZM243.49 59.435C244.584 59.435 245.466 60.1342 245.496 61.2438H241.498C241.666 60.0886 242.471 59.435 243.49 59.435ZM247.487 63.5998H245.192C244.918 64.1622 244.417 64.6182 243.505 64.6182C242.441 64.6182 241.59 63.919 241.483 62.6726H247.639C247.685 62.399 247.7 62.1254 247.7 61.8518C247.7 59.3438 245.982 57.687 243.55 57.687C241.058 57.687 239.325 59.3742 239.325 62.0342C239.325 64.679 241.103 66.3814 243.55 66.3814C245.633 66.3814 247.031 65.1502 247.487 63.5998ZM255.789 63.843C255.728 60.7574 251.062 61.715 251.062 60.1798C251.062 59.6934 251.472 59.3742 252.263 59.3742C253.099 59.3742 253.616 59.815 253.676 60.4686H255.713C255.592 58.7966 254.36 57.687 252.324 57.687C250.241 57.687 248.995 58.8118 248.995 60.2102C248.995 63.2958 253.752 62.3382 253.752 63.843C253.752 64.3294 253.296 64.7094 252.46 64.7094C251.609 64.7094 251.016 64.223 250.94 63.5846H248.797C248.888 65.1502 250.363 66.3814 252.476 66.3814C254.528 66.3814 255.789 65.287 255.789 63.843ZM264.072 63.843C264.011 60.7574 259.345 61.715 259.345 60.1798C259.345 59.6934 259.755 59.3742 260.546 59.3742C261.382 59.3742 261.899 59.815 261.959 60.4686H263.996C263.875 58.7966 262.643 57.687 260.607 57.687C258.524 57.687 257.278 58.8118 257.278 60.2102C257.278 63.2958 262.035 62.3382 262.035 63.843C262.035 64.3294 261.579 64.7094 260.743 64.7094C259.892 64.7094 259.299 64.223 259.223 63.5846H257.08C257.171 65.1502 258.646 66.3814 260.759 66.3814C262.811 66.3814 264.072 65.287 264.072 63.843Z" fill="#FCBE00"></path>
                    </svg>
    
                    <p style="font-weight: bold; color: #000; margin-top: 15px; font-size: 18px;">
                      Tax Invoice/Bill Of Supply DJT Retailers<br> Private Limited
                    </p>
                    <p style="margin: 15px auto;">
                      A2, Test Street <br>
                      Test Area Bangaluru 560001, Karnataka
                    </p>
                    <p>
                      <b>GSTIN:</b> 0987653456789
                    </p>
                    <p>
                      <b>CIN:</b> 0987653456789
                    </p>
                    <p>
                      <b>FSSAI No. :</b> 0987653456789
                    </p>
                    <hr style="border: 1px dashed rgb(131, 131, 131); margin: 25px auto">
                  </div>
                  <table style="width: 100%; table-layout: fixed">
                    <thead>
                      <tr>
                        <th style="width: 50px; padding-left: 0;">Sn.</th>
                        <th style="width: 220px;">Item Name</th>
                        <th>QTY</th>
                        <th style="text-align: right; padding-right: 0;">Price</th>
                      </tr>
                    </thead>
                    <tbody>';
foreach ($_SESSION['cart'] as $key => $value) {
    $html .= '<tr class="invoice-items">
                        <td>' . $sn . '</td>
                        <td >' . $value['name'] . '</td>
                        <td>' . $value['quantity'] . '</td>
                        <td style="text-align: right;">' . $value['price'] * $value['quantity'] . '</td>
                      </tr>';
    $total += ($value['price'] * $value['quantity']);
    $sn += 1;
}
$html .= '</tbody>
                 </table> <table style="width: 100%;
                  background: #fcbd024f;
                  border-radius: 4px;">
                    
                 
                  </table>
    
                  <table style="width: 100%;
                  margin-top: 15px;
                  border: 1px dashed #00cd00;
                  border-radius: 3px;">
                    <thead>
                      <tr>
                        <td>Total Saving In Rs: </td>
                        <td style="text-align: right;">₹ ' . $total . 's</td>
                      </tr>
                      
                    </thead>
                 
                  </table>
    
        </section>
      </body>
    </html>
    ';

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
// $mpdf->WriteHTML($js, 3);

$mpdf->Output('invoice.pdf', 'D');
?>