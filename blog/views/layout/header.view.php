<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A Simple Blog</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/yegor256/tacit@gh-pages/tacit-css-1.6.0.min.css"/> -->
    <!-- <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css"> -->

    <style>

        .page-container > header:not(.single-header){
            display: flex;
            justify-content: space-between;
            align-items: center;
            /* padding-right: 1rem; */
        }

        .page-container > header p {
            padding: .5rem;
            background-color: rgba(0, 0, 0, 0.05);
        }

        .page-container > header  span {
            margin: .5rem;
        }


        .main{
            width: 40rem;
            /* border: 1px solid black; */
            /* margin-left: auto;
            margin-right: auto; */
            margin-left: 11%;
        }

        aside{
            width: 20rem;
            /* border: 1px solid black; */
            background-color: #FDFDFD;
        }

        .main >  h2  span {
            font-size: 1rem;
        }

        /* figure{
            text-align: right;
        } */

        figcaption{
            text-align: center;
            box-shadow: 3px 6px 6px rgba(0, 0, 0, 0.2);
            margin-bottom: 1rem;
            background-color: #08789E1A;
            color: black #0000001A;
        }

        ul{
            text-align: center;
            /* padding-left: 1rem; */
        }

        .page-container > header:not(.single-header){
            width: 100%;
            /* text-align: center; */
            /* border: 1px solid black; */
            padding-left: 11%;
        }

        .page-container{
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            /* border: 5px solid green; */
        }

        .pagination-container{
            width: 100%;
            display: flex;
            justify-content: space-between;
            padding: 1rem;
        }

        .hidden{
            display: none;
        }

        figure.hashtags figcaption{
            background-color: initial;
            box-shadow: initial;
            text-align: left;
            color: #415462;
            padding: initial;
        }

        figure.hashtags ul li{
            text-align: left;
            list-style: none;
        }

        figure img{
            display: block;
            width: 98%;
            height: 15rem;
            object-fit: cover;
            /* object-position: top; */
            margin: auto;
        }

        .last-pagination-elem{
            background-color: #415462;
            color: white;
            padding: .3rem;
        }

        .all-posts{
            display: block;
            background-color: white;
            color: deeppink;
            width: 80%;
            padding: .5rem 1rem;
            text-align: center;
            margin: 1rem auto;
            border: 1px solid  #415462;
        }

        .card-link{
            text-decoration: initial;
            cursor: pointer;
        }

        .single-header{
            /* border: 1px solid black; */
            width: 100%;
            padding-bottom: 0;
        }

        .single-header img{
            width: 100%;
            height: 50svh;
            object-fit: cover;
            object-position: center;
        }

        .single-header h1 {
            text-align: center;
            margin-bottom: 0;
        }

        .single-header + main{
            padding: 2rem;
        }
    </style>
</head>
<body>
    <div class="page-container">
    
