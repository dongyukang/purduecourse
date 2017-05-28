![Intro](http://i.imgur.com/Q75Yyrr.png)

***

### Synopsis

This Laravel package completely depends on [Purdue API](https://github.com/Purdue-io/PurdueApi).
I developed this package, because I wanted to ease off the process of using Purdue Course API, at the same time, I wanted to provide a tool that helps to focus on what we want to build without spending too much time on writing long queries. I believe that my primary goal of making the Purdue API as easily usable and approachable as possible in PHP is getting successful and hope it will be further developed and upgraded in the future.

### Introduction    

As this package is based on the Purdue API, requesting to the web to obtain the data is necessary.
Thus, it requires to use a [GuzzleHttp](https://github.com/guzzle/guzzle) package.

### Purpose and Usage

I developed this package primarily to reduce amount of time and code that I should spend and write to retrieve Purdue course data.

For instance, if you want to request every data of 'CS 180' during Fall semester of 2016. You just write a single line of code,

```php
Purdue::fall(2016)->course('cs 180')->all();
```

instead of lines of sending requests, writing queries, parsing data and all other time consuming tasks, this package will take care of every long and repeating process.

Below is a screenshot of result data that you will get from the code above.

![Result](http://i.imgur.com/bHTI9p3.png)

This package is still in development phase yet.<br>
For more detail, refer to [WIKI](https://github.com/dongyukang/purduecourse/wiki)
