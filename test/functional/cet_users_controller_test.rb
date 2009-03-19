require 'test_helper'

class CetUsersControllerTest < ActionController::TestCase
  test "should get index" do
    get :index
    assert_response :success
    assert_not_nil assigns(:cet_users)
  end

  test "should get new" do
    get :new
    assert_response :success
  end

  test "should create cet_users" do
    assert_difference('CetUsers.count') do
      post :create, :cet_users => { }
    end

    assert_redirected_to cet_users_path(assigns(:cet_users))
  end

  test "should show cet_users" do
    get :show, :id => cet_users(:one).to_param
    assert_response :success
  end

  test "should get edit" do
    get :edit, :id => cet_users(:one).to_param
    assert_response :success
  end

  test "should update cet_users" do
    put :update, :id => cet_users(:one).to_param, :cet_users => { }
    assert_redirected_to cet_users_path(assigns(:cet_users))
  end

  test "should destroy cet_users" do
    assert_difference('CetUsers.count', -1) do
      delete :destroy, :id => cet_users(:one).to_param
    end

    assert_redirected_to cet_users_path
  end
end
