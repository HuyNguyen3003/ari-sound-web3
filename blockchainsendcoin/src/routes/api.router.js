const express = require('express');
const router = express.Router();
const userlogger = require('../logs/logger.log');
const sendReward = require('../services/contract.service');






router.route('/api/checkstatus')
          .get((req, res) => {
                    try {
                              const response = {
                                        status: 'success',
                                        message: 'System is operating normally.'
                              }
                              userlogger.log('Call api to check service', { context: "get:api/checkstatus", metadata: response });
                              return res.status(200).json(response)
                    } catch (e) {
                              userlogger.error('Internal Server Error. Please try again later.', { context: "get:api/checkstatus", metadata: e });
                              return res.status(500).json(response)
                    }
          })
router.route('/api/sendreward')
          .post(async (req, res) => {
                    try {
                              const { receiverAddress, amount } = req.body;
                              const response = await sendReward(receiverAddress, amount);

                              userlogger.log('Call api to send reward', { context: "post:api/sendreward", metadata: response });
                              return res.status(200).json(response)
                    } catch (e) {
                              userlogger.error('Internal Server Error. Please try again later.', { context: "post:api/sendreward", metadata: e });
                              return res.status(500).json(response)
                    }
          })



module.exports = router;