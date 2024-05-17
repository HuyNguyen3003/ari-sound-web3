function clearSelectOptions(selectElement) {

          while (selectElement.options.length > 0) {
                    selectElement.remove(0);
          }

}
function connectmetamask(elementcoinnumber, elementwalletSelect, tokenwallet, elementsubmit) {
          if (typeof ethereum !== 'undefined') {
                    // Gửi yêu cầu để lấy danh sách các tài khoản đang được kết nối
                    ethereum
                              .request({
                                        method: 'wallet_requestPermissions',
                                        params: [{ eth_accounts: {} }],
                              })
                              .then(() => {
                                        // Sau khi người dùng đã cấp quyền, lấy danh sách các tài khoản đã được kết nối
                                        clearSelectOptions(elementwalletSelect);
                                        return ethereum.request({ method: 'eth_accounts' });
                              })
                              .then((accounts) => {
                                        if (accounts.length > 0) {

                                                  // display submit button
                                                  elementsubmit.style.display = 'block';
                                                  // display coin number input
                                                  elementcoinnumber.style.display = 'block';
                                                  elementcoinnumber.value = '0.01';
                                                  elementcoinnumber.min = '0.01';
                                                  elementcoinnumber.max = tokenwallet;
                                                  elementcoinnumber.step = '0.01';


                                                  // display wallet select
                                                  elementwalletSelect.style.display = 'block';
                                                  // clear select options

                                                  // add address to select options
                                                  accounts.forEach((account) => {
                                                            const option = document.createElement('option');
                                                            option.value = account;
                                                            option.text = account;
                                                            elementwalletSelect.appendChild(option);
                                                  });
                                        } else {
                                                  alert('No wallet is currently connected.');
                                        }
                              })
                              .catch((error) => {
                                        alert('Error requesting wallet access:', error);
                              });
          } else {
                    alert(
                              'Ethereum provider not found. Please install MetaMask or another wallet.'
                    );
          }
}

function submitsendcoin(address, amount) {
          fetch('http://localhost:8888/api/sendreward', {
                    method: 'POST',
                    headers: {
                              'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                              address: address,
                              amount: amount,
                    }),
          })
                    .then((response) => response.json())
                    .then((data) => {
                              console.log('Success:', data);
                    })
                    .catch((error) => {
                              console.error('Error:', error);
                    });
}