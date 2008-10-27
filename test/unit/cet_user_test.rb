require File.dirname(__FILE__) + '/../test_helper'

class CetUserTest < Test::Unit::TestCase
  # Be sure to include AuthenticatedTestHelper in test/test_helper.rb instead.
  # Then, you can remove it from this and the functional test.
  include AuthenticatedTestHelper
  fixtures :cet_users

  def test_should_create_cet_user
    assert_difference CetUser, :count do
      cet_user = create_cet_user
      assert !cet_user.new_record?, "#{cet_user.errors.full_messages.to_sentence}"
    end
  end

  def test_should_require_login
    assert_no_difference CetUser, :count do
      u = create_cet_user(:login => nil)
      assert u.errors.on(:login)
    end
  end

  def test_should_require_password
    assert_no_difference CetUser, :count do
      u = create_cet_user(:password => nil)
      assert u.errors.on(:password)
    end
  end

  def test_should_require_password_confirmation
    assert_no_difference CetUser, :count do
      u = create_cet_user(:password_confirmation => nil)
      assert u.errors.on(:password_confirmation)
    end
  end

  def test_should_require_email
    assert_no_difference CetUser, :count do
      u = create_cet_user(:email => nil)
      assert u.errors.on(:email)
    end
  end

  def test_should_reset_password
    cet_users(:quentin).update_attributes(:password => 'new password', :password_confirmation => 'new password')
    assert_equal cet_users(:quentin), CetUser.authenticate('quentin', 'new password')
  end

  def test_should_not_rehash_password
    cet_users(:quentin).update_attributes(:login => 'quentin2')
    assert_equal cet_users(:quentin), CetUser.authenticate('quentin2', 'test')
  end

  def test_should_authenticate_cet_user
    assert_equal cet_users(:quentin), CetUser.authenticate('quentin', 'test')
  end

  def test_should_set_remember_token
    cet_users(:quentin).remember_me
    assert_not_nil cet_users(:quentin).remember_token
    assert_not_nil cet_users(:quentin).remember_token_expires_at
  end

  def test_should_unset_remember_token
    cet_users(:quentin).remember_me
    assert_not_nil cet_users(:quentin).remember_token
    cet_users(:quentin).forget_me
    assert_nil cet_users(:quentin).remember_token
  end

  protected
    def create_cet_user(options = {})
      CetUser.create({ :login => 'quire', :email => 'quire@example.com', :password => 'quire', :password_confirmation => 'quire' }.merge(options))
    end
end
