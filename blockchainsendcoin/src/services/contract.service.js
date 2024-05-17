const { ethers } = require("ethers");

// base data
const provider = new ethers.JsonRpcProvider(process.env.RPC_URL);
const privateKey = process.env.PRIVATE_KEY

// sign
const wallet = new ethers.Wallet(privateKey, provider);

// info contract
const contractABI = require('../utils/contract.abi.json');
const contractAddress = process.env.CONTRACT_ADDRESS;
// connect contract
const contract = new ethers.Contract(contractAddress, contractABI, provider);
const contractWithSigner = contract.connect(wallet);


async function sendReward(receiverAddress, amount) {
          try {
                    const amountToSend = ethers.parseEther(amount);
                    const tokenAddress = process.env.TOKEN_ADDRESS;
                    const tx = await contractWithSigner.sendReward(receiverAddress, tokenAddress, amountToSend);
                    await tx.wait();
                    const response = {
                              status: '200',
                              message: `Send reward successfully. Tx hash: ${tx.hash}`
                    }
                    return response;

          } catch (error) {
                    const response = {
                              status: '400',
                              message: `Send reward failed, e::${error.message}`
                    }
                    return response;
          }
}
module.exports = sendReward;

