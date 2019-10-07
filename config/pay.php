<?php
return [
    'app_id' => '2016100100643066',
    'notify_url' => 'http://www.laravel.com/index/alipaynotify',
    'return_url' => 'http://www.laravel.com/index/alipayreturn',
    //编码格式
    'charset' => "UTF-8",
    //签名方式
    'sign_type'=>"RSA2",
    //支付宝网关
    'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

    'ali_public_key' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA68wewn2Z/rYWjDR8qkZr9H1BoXLoI9RwmJ8Zho2qros5s+FMXBL/qbKAe3+iMbF9dDd2n1aCeCTcbY/A5We+SavhfyJqbqgolpOnmoGj2YaLEA7stI+3GYx4lYpWPZqLvX4eRFBpVSClikOIeYNAwbcYVI8dYk45ZLjwoPZwFuV7MmBcO9DEmpHZDu1E0jVlYmtNV/dgjRpP+oIGb8Kor0ijYcjGtg6tVUIOvWZ1Bn/MPx8Tc3cBp/VPMIFMF7E4ykfvS/8uJkShLr5ZLWe2j9/oVhV+epXK0xFaKTE7AFsruCYVMOQe/YFw8OpJrnF1hLsxxh0JdfDDfmSJ31qiEQIDAQAB',
    'private_key' => 'MIIEpAIBAAKCAQEA68wewn2Z/rYWjDR8qkZr9H1BoXLoI9RwmJ8Zho2qros5s+FMXBL/qbKAe3+iMbF9dDd2n1aCeCTcbY/A5We+SavhfyJqbqgolpOnmoGj2YaLEA7stI+3GYx4lYpWPZqLvX4eRFBpVSClikOIeYNAwbcYVI8dYk45ZLjwoPZwFuV7MmBcO9DEmpHZDu1E0jVlYmtNV/dgjRpP+oIGb8Kor0ijYcjGtg6tVUIOvWZ1Bn/MPx8Tc3cBp/VPMIFMF7E4ykfvS/8uJkShLr5ZLWe2j9/oVhV+epXK0xFaKTE7AFsruCYVMOQe/YFw8OpJrnF1hLsxxh0JdfDDfmSJ31qiEQIDAQABAoIBAFDFFdBHV+WxF94k6IMnJjmUYlPcWXpUfdE5xnOZuVqapERiq1Zqx5qoY2xqVvOwuamCiiagaoafEcaR1GCAfeUcdFypPE31WhniMCozuB1+AcqZYimjhPPCc1e+EDZ/5tgdCF8cMEiRq0LGSUxeUmNIxZPJhiYzZ2OCGiL454Jfpr0naPSDqRIrqE3sf1v8SVUKQUCNjW2AS83lA7ZWZ6ra9jL8JCtFY0Ws1R6xlp+7BogQdL0RVDrs1Qu+KkioSj5/8zxG9ny5hPN7MgZPivtm87ihSOLyBY5fdQKPSFo91ZQ0XAsUIyBk33LL3huRp2xj99S0KDxGmgaW3Ak4yPECgYEA/kon5qqXN78qfv0Vsnj0eKB+l78XSp8Q3yr6+Qau8qvszoKudeXC8Ye9g0GA/EYyptNURYiFhiaGzt+0gTSnwOOMt56cW7iwj2iOYPfOMMi0cFd4F7CXcIvesBX1TaFwDVi6g11oUSpwcu5G/Os8inQZiGD9SJBYZlGINkwpe+0CgYEA7WIfpMpiWIFC2tUzKZEOO2p/bNJIjfPPbUvRVw/9k5Ulm059UfjdE/mUhg+t5e/wNCF2qMUpjPkZv/PkaLzljzlfBa5jJNtlLnFgf2TCNRYp2Rb+6HUA3fxJjvfxHtVvJuEgMFfJUtGkE/dPe/re2uq7l00brt/K5sH/oui4ojUCgYEA5a+dsuBLjnMBs4puWrKeP4bYUcCtDR34Y1uzLdQ3mcJpN28anitWlkuBhllYZIYTolQoPlY+JRoPkjTGGh6xl6zxobmGieKcuCw8zqGGgNIJCaA4PU2ovGPaVTrAQ8qaJ7QJZDauzwGCaI2JWVIxcO3FUkYpAa4/6suiOUk5/1ECgYEA1+hfj6rkOEuZWyB/IFdm8nOy4m+Avlv7VhWXmfBZW1pUkiWZpm0L55chl627JWBOwZuOKYLqf+YxnX1fSkRFJzevTaOHWYaTSOKmOjiSy2YVOfbIcvW4jC9jWD37eWf3aQ1qEY5G9qTm76IJEWLkP4kwhjUD8NJr4eahdLLm++ECgYA2XZhLerQT5b1VbiledPRmCXD2ENaT1v3lEU4i4C7XksiywQ/kDpyQweHQNVh0fCNhW56zseGzpYYA5d8TBzgmwK53T4IP0nK5EITqh6ZMZZa8fVH02Dce7tIB6U7mPIyaE4xzS84DoK8PwmtoBPSgz/Jyeoc1g8MPEAzWrTFpoA==',
    'log' => [
        'file' => storage_path('log/alipay.log'),
    ],
    'http' => [
        'timeout' => 5.0,
        'connect_timeout' => 5.0,
    ],
    'mode' => 'dev', // optional,设置此参数，将进入沙箱模式


];