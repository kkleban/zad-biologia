Feature: I would like to edit aworms

  Scenario Outline: Insert records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/awirus/"
    Then I should not see "<awirus>"
    And I follow "Create a new entry"
    Then I should see "Aworms creation"
    When I fill in "Name" with "<awirus>"
    And I fill in "Size" with "<size>"
    And I press "Create"
    Then I should see "<awirus>"
    And I should see "<size>"

  Examples:
    |awirus         |size   |
    |HIV            |430    |
    |AIDS           |475    |
    |VARIOLA        |305    |



  Scenario Outline: Edit records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/awirus/"
    Then I should not see "<new-awirus>"
    When I follow "<old-awirus>"
    Then I should see "<old-awirus>"
    When I follow "Edit"
    And I fill in "Name" with "<new-awirus>"
    And I fill in "Size" with "<new-size>"
    And I press "Update"
    And I follow "Back to the list"
    Then I should see "<new-awirus>"
    And I should see "<new-size>"
    And I should not see "<old-awirus>"

  Examples:
    |awirus        |new-awirus |new-size  |
    |HIV           |NEWHIV     |500       |
    |AIDS          |NEWAIDS    |400       |


  Scenario Outline: Delete records
    Given I am on homepage
    And I follow "Login"
    And I fill in "Username" with "admin"
    And I fill in "Password" with "loremipsum"
    And I press "Login"
    And I go to "/admin/awirus/"
    Then I should see "<awirus>"
    When I follow "<awirus>"
    Then I should see "<awirus>"
    When I press "Delete"
    Then I should not see "<awirus>"

  Examples:
    |awirus     |
    |NEWHIV     |
    |VARIOLA    |
    |NEWAIDS    |

