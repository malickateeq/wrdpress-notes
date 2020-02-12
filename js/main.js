var portfolioPostsBtn = document.getElementById('portfolio-posts-btn');
var portfolioPostsContainer = document.getElementById('portfolio-posts-container');

if(portfolioPostsBtn)
{
    portfolioPostsBtn.addEventListener('click', function()
    {
        // Ajax request
        var ourRequest = new XMLHttpRequest();
        ourRequest.open('GET',  magicalData.siteURL+'/wp-json/wp/v2/posts');
        
        ourRequest.onload = function ()
        {
            if(ourRequest.status >= 200 && ourRequest.status <400 )
            {
                var data = JSON.parse(ourRequest.responseText);
                jsonToHTML(data);
            }
            else
            {
                console.log('error');
            }
        };
        ourRequest.onerror = function()
        {
            console.log('conn error');
        };
        ourRequest.send();
    });
}

function jsonToHTML(postsData)
{
    var ourHtmlSring = '';
    for( var i=0; i<postsData.length; i++ )
    {
        ourHtmlSring += '<h2>'+postsData[i].title.rendered+'</h2>';
        ourHtmlSring += postsData[i].content.rendered;
    }
    portfolioPostsContainer.innerHTML = ourHtmlSring;
    portfolioPostsBtn.remove();
}

// Quich add post ajax
var quickaddBtn = document.getElementById('quick-add-btn');
if (quickaddBtn)
{
    quickaddBtn.addEventListener('click', function()
    {
        // get data
        var ourData = {
            "title": document.querySelector('.admin-quick-add [name="title"]').value,
            "content": document.querySelector('.admin-quick-add [name="content"]').value,
            "status": "publish"
        }

        // Ajax request
        var crearePost = new XMLHttpRequest();
        crearePost.open('POST', magicalData.siteURL+'/wp-json/wp/v2/posts');
        crearePost.setRequestHeader("X-WP-Nonce", magicalData.nonce);  // unique code for security purposes
        crearePost.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
        crearePost.send( JSON.stringify(ourData) );

        crearePost.onreadystatechange = function()
        {
            if(crearePost.readyState == 4)
            {
                if(crearePost.status == 201)
                {
                    document.querySelector('.admin-quick-add [name="title"]').value = "";
                    document.querySelector('.admin-quick-add [name="content"]').value = "";
                }
                else
                {
                    alert("Error - try again!");
                }
            }
        }
    });
}
