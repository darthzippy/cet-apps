class CheckoutsController < ApplicationController
  def create
    @user = User.find(params[:user_id])
    @checkout = @user.checkouts.build(params[:checkout])
    
    respond_to do |format|
      if @checkout.save
        flash[:notice] = 'Checkout was succesfully created'
        format.html { redirect_to @user }
      else
        flash[:error] = @checkout.errors.full_message_to_setence
        format.html { redirect_to @user}
      end
    end  
  end
  
  def destroy
    @user = User.find(params[:user_id])
    @checkout = @user.checkouts.find(params[:id])
    
    @checkout.destroy
    
    respond_to do |format|
      flash[:notice] = 'Checkout was successfully deleted'
      format.html { redirect_to @user }
      format.js # renders destroy.js.rjs
    end
  end
end
