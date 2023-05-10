// public/assets/js/like-button.js

$(function() {
    // Get the like button and likes count elements
    const likeButton = $('.post__header-btn .heart-tumblr');
    const likesCount = $('.post__reblogs');
  
    // Add an event listener to the like button
    likeButton.on('click', function(event) {
      event.preventDefault();
  
      // Send an AJAX request to update the likes count
      $.ajax({
        type: 'POST',
        url: $(this).attr('href'),
        success: function(response) {
          // Update the likes count displayed in the post header
          likesCount.text(response.likesCount);
        },
        error: function(xhr, status, error) {
          console.log('Error updating likes count:', error);
        }
      });
    });
  });
  
